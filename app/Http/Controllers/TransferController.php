<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transfer;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function index(Request $request)
{
    $query = $request->input('search');
    $transfers = Transfer::when($query, function ($q) use ($query) {
        $q->whereHas('sourceAccount', function ($sourceQuery) use ($query) {
            $sourceQuery->where('name', 'like', '%' . $query . '%');
        })->orWhereHas('destinationAccount', function ($destinationQuery) use ($query) {
            $destinationQuery->where('name', 'like', '%' . $query . '%');
        });
    })->with(['sourceAccount', 'destinationAccount'])->get();

    return view('transfers.index', compact('transfers'));
}

    public function create()
    {
        $accounts = Account::all();
        return view('transfers.create', compact('accounts'));
    }

    public function store(Request $request)
{
    $transferMode = $request->input('transfer_mode');

    if ($transferMode === 'regular') {
        // Handle Regular Transfer
        $sourceAccount = Account::find($request->source_account_id);
        $destinationAccount = Account::find($request->destination_account_id);

        if ($sourceAccount->balance < $request->amount) {
            return redirect()->back()->with('warning', 'Insufficient balance. Transfer will proceed but may result in a negative balance.');
        }

        Transfer::create([
            'source_account_id' => $request->source_account_id,
            'destination_account_id' => $request->destination_account_id,
            'amount' => $request->amount,
            'transfer_date' => $request->transfer_date,
            'location' => $request->location,
        ]);

        $sourceAccount->balance -= $request->amount;
        $destinationAccount->balance += $request->amount;

        $sourceAccount->save();
        $destinationAccount->save();

    } elseif ($transferMode === 'distributed') {
        // Handle Distributed Transfer
        $sourceAccount = Account::find($request->source_account_id);

        foreach ($request->input('distributed_amounts') as $accountId => $amount) {
            if ($amount > 0) {
                $destinationAccount = Account::find($accountId);

                Transfer::create([
                    'source_account_id' => $request->source_account_id,
                    'destination_account_id' => $accountId,
                    'amount' => $amount,
                    'transfer_date' => $request->transfer_date,
                    'location' => $request->location,
                ]);

                $sourceAccount->balance -= $amount;
                $destinationAccount->balance += $amount;

                $sourceAccount->save();
                $destinationAccount->save();
            }
        }
    }

    return redirect()->route('transfers.index')->with('success', 'Transfer completed successfully.');
}
}