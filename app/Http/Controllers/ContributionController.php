<?php
namespace App\Http\Controllers;

use App\Models\Contribution;
use App\Models\Member;
use App\Models\Fund;
use Illuminate\Http\Request;

class ContributionController extends Controller
{
    /**
     * Display a listing of the contributions.
     */
    public function index()
    {
        // Fetch all contributions with related data
        $contributions = Contribution::with(['member', 'fund'])->get();

        // Fetch all funds with their current balances
        $funds = Fund::all();

        // Fetch all members for the filter dropdown
        $members = Member::all();

        return view('contributions.index', compact('contributions', 'funds', 'members'));
    }

    /**
     * Show the form for creating a new contribution.
     */
    public function create()
    {
        // Fetch all members and funds for dropdowns
        $members = Member::all();
        $funds = Fund::all();

        return view('contributions.create', compact('members', 'funds'));
    }

    /**
     * Store a newly created contribution in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'host' => 'nullable|string|max:255',
            'date' => 'required|date',
            'amounts' => 'required|array',
        ]);

        $memberId = $validated['member_id'];
        $member = Member::find($memberId);

        // Loop through each fund contribution
        foreach ($validated['amounts'] as $fundId => $amount) {
            if ($amount > 0) {
                // Create the contribution
                Contribution::create([
                    'member_id' => $memberId,
                    'fund_id' => $fundId,
                    'amount' => $amount,
                    'date' => $validated['date'],
                    'host' => $validated['host'],
                ]);

                // Update member balance
                $member->balance += $amount;
                $member->save();

                // Update fund balance
                $fund = Fund::find($fundId);
                $fund->balance += $amount;
                $fund->save();
            }
        }

        return redirect()->route('contributions.index')->with('success', 'Contributions recorded successfully.');
    }

    /**
     * Display the specified contribution.
     */
    public function show(Contribution $contribution)
    {
        return view('contributions.show', compact('contribution'));
    }

    /**
     * Show the form for editing the specified contribution.
     */
    public function edit(Contribution $contribution)
    {
        // Fetch all members and funds for dropdowns
        $members = Member::all();
        $funds = Fund::all();

        return view('contributions.edit', compact('contribution', 'members', 'funds'));
    }

    /**
     * Update the specified contribution in storage.
     */
    public function update(Request $request, Contribution $contribution)
    {
        // Validate the request
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'fund_id' => 'required|exists:funds,id',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'host' => 'nullable|string|max:255',
        ]);

        // Reverse old contribution amounts
        $oldAmount = $contribution->amount;
        $member = Member::find($contribution->member_id);
        $fund = Fund::find($contribution->fund_id);

        $member->balance -= $oldAmount;
        $fund->balance -= $oldAmount;

        // Apply new contribution amounts
        $member->balance += $validated['amount'];
        $fund->balance += $validated['amount'];

        // Save changes
        $member->save();
        $fund->save();
        $contribution->update($validated);

        return redirect()->route('contributions.index')->with('success', 'Contribution updated successfully.');
    }

    /**
     * Remove the specified contribution from storage.
     */
    public function destroy(Contribution $contribution)
    {
        // Reverse contribution amounts
        $member = Member::find($contribution->member_id);
        $fund = Fund::find($contribution->fund_id);

        $member->balance -= $contribution->amount;
        $fund->balance -= $contribution->amount;

        $member->save();
        $fund->save();
        $contribution->delete();

        return redirect()->route('contributions.index')->with('success', 'Contribution deleted successfully.');
    }

    /**
     * Handle AJAX search for contributions.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Filter contributions based on the search query
        $contributions = Contribution::with(['member', 'fund'])
            ->whereHas('member', function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->orWhereHas('fund', function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->orWhere('host', 'like', "%{$query}%")
            ->get()
            ->map(function ($contribution) {
                return [
                    'id' => $contribution->id,
                    'member_name' => $contribution->member->name,
                    'fund_name' => $contribution->fund->name,
                    'amount' => $contribution->amount,
                    'date' => $contribution->date,
                    'host' => $contribution->host,
                ];
            });

        // Calculate total balances for each fund based on filtered contributions
        $fundBalances = Fund::all()->map(function ($fund) use ($contributions) {
            $totalBalance = $contributions
                ->where('fund_name', $fund->name)
                ->sum('amount');

            return [
                'name' => $fund->name,
                'type' => $fund->type,
                'balance' => $totalBalance,
            ];
        });

        return response()->json([
            'contributions' => $contributions,
            'fundBalances' => $fundBalances,
        ]);
    }
}