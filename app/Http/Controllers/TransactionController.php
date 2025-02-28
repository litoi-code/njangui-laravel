<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Display all transactions
    public function index()
    {
        $transactions = Transaction::with(['member', 'fund', 'loan', 'penalty'])->get();
        return view('transactions.index', compact('transactions'));
    }

    // Show a specific transaction
    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }
}