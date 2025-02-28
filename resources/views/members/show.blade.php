@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Member Details</h1>

    <!-- Member Information -->
    <div class="mb-8">
        <h2 class="text-xl font-bold mb-2">{{ $member->name }}</h2>
        <p class="text-gray-600">Balance: ${{ number_format($member->balance, 2) }}</p>
    </div>

    <!-- Contributions -->
    <h2 class="text-xl font-bold mb-4">Contributions</h2>
    @if ($contributions->isEmpty())
        <p class="text-gray-500">No contributions found for this member.</p>
    @else
        <table class="w-full border-collapse mb-8">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2">Fund</th>
                    <th class="p-2">Amount</th>
                    <th class="p-2">Date</th>
                    <th class="p-2">Host</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contributions as $contribution)
                <tr class="border-b">
                    <td class="p-2">{{ $contribution->fund->name }}</td>
                    <td class="p-2">${{ number_format($contribution->amount, 2) }}</td>
                    <td class="p-2">{{ $contribution->date }}</td>
                    <td class="p-2">{{ $contribution->host ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Loans -->
    <h2 class="text-xl font-bold mb-4">Loans</h2>
    @if ($loans->isEmpty())
        <p class="text-gray-500">No loans found for this member.</p>
    @else
        <table class="w-full border-collapse mb-8">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2">Fund</th>
                    <th class="p-2">Loan Amount</th>
                    <th class="p-2">Interest Rate</th>
                    <th class="p-2">Total to Repay</th>
                    <th class="p-2">Remaining Balance</th>
                    <th class="p-2">Start Date</th>
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
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Penalties -->
    <h2 class="text-xl font-bold mb-4">Penalties</h2>
    @if ($penalties->isEmpty())
        <p class="text-gray-500">No penalties found for this member.</p>
    @else
        <table class="w-full border-collapse mb-8">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2">Amount</th>
                    <th class="p-2">Reason</th>
                    <th class="p-2">Paid</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penalties as $penalty)
                <tr class="border-b">
                    <td class="p-2">${{ number_format($penalty->amount, 2) }}</td>
                    <td class="p-2">{{ $penalty->reason }}</td>
                    <td class="p-2">{{ $penalty->paid ? 'Yes' : 'No' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Back Button -->
    <a href="{{ route('members.index') }}" class="mt-6 inline-block bg-blue-500 text-white px-4 py-2">Back to Members</a>
</div>
@endsection