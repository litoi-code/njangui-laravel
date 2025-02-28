@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Member Details</h1>

    <!-- Member Information -->
    <div class="mb-8">
        <h2 class="text-xl font-bold mb-2">{{ $member->name }}</h2>
        <p class="text-gray-600">Balance: ${{ number_format($member->balance, 2) }}</p>
    </div>

    <!-- Loans Table -->
    <h2 class="text-xl font-bold mb-4">Loans</h2>
    @if ($loans->isEmpty())
        <p class="text-gray-500">No loans found for this member.</p>
    @else
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2">Fund</th>
                    <th class="p-2">Loan Amount</th>
                    <th class="p-2">Interest Rate</th>
                    <th class="p-2">Total to Repay</th>
                    <th class="p-2">Remaining Balance</th>
                    <th class="p-2">Start Date</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loans as $loan)
                @php
                    // Calculate accumulated interest
                    $startDate = \Carbon\Carbon::parse($loan->start_date);
                    $elapsedMonths = $startDate->diffInMonths(\Carbon\Carbon::now());
                    $accumulatedInterest = $loan->amount * ($loan->interest_rate / 100) * $elapsedMonths;
                    $totalToRepay = $loan->amount + $accumulatedInterest;
                @endphp
                <tr class="border-b">
                    <td class="p-2">{{ $loan->fund->name }}</td>
                    <td class="p-2">${{ number_format($loan->amount, 2) }}</td>
                    <td class="p-2">{{ $loan->interest_rate }}%</td>
                    <td class="p-2">${{ number_format($totalToRepay, 2) }}</td>
                    <td class="p-2">${{ number_format($loan->remaining_balance, 2) }}</td>
                    <td class="p-2">{{ $loan->start_date }}</td>
                    <td class="p-2 flex space-x-2">
                        <!-- Repayment Form -->
                        <form action="{{ route('loans.repay', $loan) }}" method="POST" class="inline">
                            @csrf
                            <div class="flex items-center space-x-2">
                                <input 
                                    type="number" 
                                    step="0.01" 
                                    name="amount" 
                                    min="0" 
                                    max="{{ $loan->remaining_balance }}" 
                                    class="border p-2 w-24" 
                                    placeholder="Amount" 
                                    required
                                >
                                <button type="submit" class="bg-green-500 text-white px-2 py-1">Repay</button>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Back Button -->
    <a href="{{ route('members.index') }}" class="mt-6 inline-block bg-blue-500 text-white px-4 py-2">Back to Members</a>
</div>
@endsection