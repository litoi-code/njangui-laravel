<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transfer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Fetch search query and date filters
        $query = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Default to the current month if no date range is provided
        if (empty($startDate) && empty($endDate)) {
            $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
            $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        }

        // Fetch transfers with optional filtering
        $transfers = Transfer::when($query, function ($q) use ($query) {
            $q->whereHas('sourceAccount', function ($sourceQuery) use ($query) {
                $sourceQuery->where('name', 'like', '%' . $query . '%');
            })->orWhereHas('destinationAccount', function ($destinationQuery) use ($query) {
                $destinationQuery->where('name', 'like', '%' . $query . '%');
            });
        })
        ->when($startDate, function ($q) use ($startDate) {
            $q->whereDate('transfer_date', '>=', $startDate);
        })
        ->when($endDate, function ($q) use ($endDate) {
            $q->whereDate('transfer_date', '<=', $endDate);
        })
        ->with(['sourceAccount', 'destinationAccount'])
        ->get(); // Paginate with 10 items per page

        $accounts = Account::all(); // Required for destination totals

        return view('transfers.index', compact('transfers', 'accounts', 'query', 'startDate', 'endDate'));
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

    /**
     * Remove the specified transfer from storage.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Transfer $transfer)
    {
        // Reverse the balance changes made during the transfer
        $sourceAccount = $transfer->sourceAccount;
        $destinationAccount = $transfer->destinationAccount;

        if ($sourceAccount && $destinationAccount) {
            $sourceAccount->balance += $transfer->amount; // Restore source account balance
            $destinationAccount->balance -= $transfer->amount; // Deduct destination account balance

            $sourceAccount->save();
            $destinationAccount->save();
        }

        // Delete the transfer record
        $transfer->delete();

        return redirect()->route('transfers.index')->with('success', 'Transfer deleted successfully.');
    }
}