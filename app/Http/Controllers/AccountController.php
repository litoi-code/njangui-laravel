<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $accounts = Account::when($query, function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%');
        })->get();

        return view('accounts.index', compact('accounts'));
    }

    public function create()
    {
        return view('accounts.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'type' => 'required|in:Checking,Savings,Investment',
            'balance' => 'nullable|numeric|min:0', // Allow balance to be nullable
        ]);

        // Set default balance to 0 if not provided
        $validatedData['balance'] = $validatedData['balance'] ?? 0;

        Account::create($validatedData);

        return redirect()->route('accounts.index')->with('success', 'Account created successfully.');
    }

    public function edit(Account $account)
    {
        return view('accounts.edit', compact('account'));
    }

    public function update(Request $request, Account $account)
    {
        $account->update($request->all());
        return redirect()->route('accounts.index')->with('success', 'Account updated successfully.');
    }

    public function destroy(Account $account)
    {
        $account->delete();
        return redirect()->route('accounts.index')->with('success', 'Account deleted successfully.');
    }
}