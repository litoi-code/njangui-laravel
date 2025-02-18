<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index(Request $request)
{
    $query = $request->input('search');
    $loans = Loan::when($query, function ($q) use ($query) {
        $q->whereHas('sourceAccount', function ($sourceQuery) use ($query) {
            $sourceQuery->where('name', 'like', '%' . $query . '%');
        })->orWhereHas('destinationAccount', function ($destinationQuery) use ($query) {
            $destinationQuery->where('name', 'like', '%' . $query . '%');
        });
    })->with(['sourceAccount', 'destinationAccount'])->get();

    return view('loans.index', compact('loans'));
}

    public function create()
    {
        $accounts = Account::all();
        return view('loans.create', compact('accounts'));
    }

    public function store(Request $request)
    {
        $loan = Loan::create([
            'source_account_id' => $request->source_account_id,
            'destination_account_id' => $request->destination_account_id,
            'principal' => $request->principal,
            'interest_rate' => $request->interest_rate,
            'loan_term_months' => $request->loan_term_months,
            'start_date' => $request->start_date,
            'location' => $request->location,
        ]);

        $monthlyInterest = ($request->principal * $request->interest_rate) / 100;
        $loan->total_repayment = $request->principal + ($monthlyInterest * $request->loan_term_months);
        $loan->save();

        return redirect()->route('loans.index')->with('success', 'Loan created successfully.');
    }
}