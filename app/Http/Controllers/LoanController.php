<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Member;
use App\Models\Fund;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    // Display all loans
    public function index()
    {
        $loans = Loan::with(['member', 'fund'])->get();
        return view('loans.index', compact('loans'));
    }

    // Show form to create a new loan
    public function create()
    {
        $members = Member::all();
        $funds = Fund::all();
        return view('loans.create', compact('members', 'funds'));
    }

    // Store a new loan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'fund_id' => 'required|exists:funds,id',
            'amount' => 'required|numeric|min:0',
            'interest_rate' => 'required|numeric|min:0',
            'start_date' => 'required|date',
        ]);

        // Calculate total amount and remaining balance
        $totalAmount = $validated['amount'] + ($validated['amount'] * $validated['interest_rate'] / 100);
        $remainingBalance = $totalAmount;

        // Create the loan
        $loan = Loan::create(array_merge($validated, [
            'total_amount' => $totalAmount,
            'remaining_balance' => $remainingBalance,
        ]));

        // Update fund balance (deduct loan amount)
        $fund = Fund::find($validated['fund_id']);
        $fund->balance -= $validated['amount'];
        $fund->save();

        return redirect()->route('loans.index')->with('success', 'Loan issued successfully.');
    }

    // Repay a loan
    public function repay(Request $request, Loan $loan)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        // Deduct repayment from remaining balance
        $loan->remaining_balance -= $validated['amount'];

        // Update fund balance (add repayment amount)
        $fund = Fund::find($loan->fund_id);
        $fund->balance += $validated['amount'];
        $fund->save();

        // Mark loan as repaid if remaining balance is zero
        if ($loan->remaining_balance <= 0) {
            $loan->remaining_balance = 0;
            $loan->save();
            return redirect()->route('loans.index')->with('success', 'Loan fully repaid.');
        }

        $loan->save();
        return redirect()->route('loans.index')->with('success', 'Loan repayment recorded successfully.');
    }

    // Delete a loan
    public function destroy(Loan $loan)
    {
        $loan->delete();
        return redirect()->route('loans.index')->with('success', 'Loan deleted successfully.');
    }
}