<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use Illuminate\Http\Request;

class FundController extends Controller
{
    // Display all funds
    public function index()
    {
        $funds = Fund::all();
        return view('funds.index', compact('funds'));
    }

    // Show form to create a new fund
    public function create()
    {
        return view('funds.create');
    }

    // Store a new fund
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:checking,saving,investment',
        ]);

        Fund::create($validated);

        return redirect()->route('funds.index')->with('success', 'Fund created successfully.');
    }

    // Show a specific fund
    public function show(Fund $fund)
    {
        return view('funds.show', compact('fund'));
    }

    // Show form to edit a fund
    public function edit(Fund $fund)
    {
        return view('funds.edit', compact('fund'));
    }

    // Update a fund
    public function update(Request $request, Fund $fund)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:checking,saving,investment',
        ]);

        $fund->update($validated);

        return redirect()->route('funds.index')->with('success', 'Fund updated successfully.');
    }

    // Delete a fund
    public function destroy(Fund $fund)
    {
        $fund->delete();
        return redirect()->route('funds.index')->with('success', 'Fund deleted successfully.');
    }
}