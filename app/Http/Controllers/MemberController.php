<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Contribution;
use App\Models\Loan;
use App\Models\Penalty;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    // Display all members
    public function index()
    {
        $members = Member::all();
        return view('members.index', compact('members'));
    }

    // Show form to create a new member
    public function create()
    {
        return view('members.create');
    }

    // Store a new member
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Member::create($validated);

        return redirect()->route('members.index')->with('success', 'Member created successfully.');
    }

    // Show a specific member
    public function show(Member $member)
    {
        // Fetch related data
        $contributions = Contribution::where('member_id', $member->id)->with('fund')->get();
        $loans = Loan::where('member_id', $member->id)->with('fund')->get();
        $penalties = Penalty::where('member_id', $member->id)->get();

        return view('members.show', compact('member', 'contributions', 'loans', 'penalties'));
    }

    // Show form to edit a member
    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    // Update a member
    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $member->update($validated);

        return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }

    // Delete a member
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
    }
}