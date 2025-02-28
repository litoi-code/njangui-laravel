<?php

namespace App\Http\Controllers;

use App\Models\Penalty;
use App\Models\Member;
use Illuminate\Http\Request;

class PenaltyController extends Controller
{
    // Display all penalties
    public function index()
    {
        $penalties = Penalty::with('member')->get();
        return view('penalties.index', compact('penalties'));
    }

    // Show form to create a new penalty
    public function create()
    {
        $members = Member::all();
        return view('penalties.create', compact('members'));
    }

    // Store a new penalty
    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'amount' => 'required|numeric|min:0',
            'reason' => 'required|string|max:255',
        ]);

        Penalty::create($validated);

        return redirect()->route('penalties.index')->with('success', 'Penalty assigned successfully.');
    }

    // Pay a penalty
    public function pay(Penalty $penalty)
    {
        // Deduct penalty amount from member's balance
        $member = Member::find($penalty->member_id);
        $member->balance -= $penalty->amount;
        $member->save();

        // Mark penalty as paid
        $penalty->paid = true;
        $penalty->save();

        return redirect()->route('penalties.index')->with('success', 'Penalty paid successfully.');
    }

    // Delete a penalty
    public function destroy(Penalty $penalty)
    {
        $penalty->delete();
        return redirect()->route('penalties.index')->with('success', 'Penalty deleted successfully.');
    }
}