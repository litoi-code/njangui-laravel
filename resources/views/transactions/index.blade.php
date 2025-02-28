@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4">Transactions</h1>
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">Type</th>
                <th class="p-2">Member</th>
                <th class="p-2">Fund</th>
                <th class="p-2">Amount</th>
                <th class="p-2">Date</th>
                <th class="p-2">Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
            <tr class="border-b">
                <td class="p-2">{{ ucfirst($transaction->type) }}</td>
                <td class="p-2">{{ $transaction->member?->name ?? '-' }}</td>
                <td class="p-2">{{ $transaction->fund?->name ?? '-' }}</td>
                <td class="p-2">${{ number_format($transaction->amount, 2) }}</td>
                <td class="p-2">{{ $transaction->date }}</td>
                <td class="p-2">{{ $transaction->description ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection