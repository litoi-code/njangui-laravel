@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    {{-- <h1 class="text-2xl font-bold mb-4">Contributions</h1> --}}

    <!-- Total Balance Per Fund -->
    <h2 class="text-xl font-bold mb-4">Solde caisses</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        @foreach ($funds as $fund)
        <div class="bg-gray-100 p-4 rounded-lg text-center">
            <h3 class="font-bold mb-2">{{ $fund->name }} ({{ ucfirst($fund->type) }})</h3>
            <p class="text-2xl font-bold">${{ number_format($fund->balance, 2) }}</p>
        </div>
        @endforeach
    </div>

    <!-- Add Contribution Button -->
    <a href="{{ route('contributions.create') }}" class="bg-blue-500 text-white px-4 py-2 mb-4 inline-block">Add Contribution</a>

    <!-- Contributions Table -->
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">Member</th>
                <th class="p-2">Fund</th>
                <th class="p-2">Amount</th>
                <th class="p-2">Date</th>
                <th class="p-2">Host</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contributions as $contribution)
            <tr class="border-b">
                <td class="p-2">{{ $contribution->member->name }}</td>
                <td class="p-2">{{ $contribution->fund->name }}</td>
                <td class="p-2">${{ number_format($contribution->amount, 2) }}</td>
                <td class="p-2">{{ $contribution->date }}</td>
                <td class="p-2">{{ $contribution->host ?? '-' }}</td>
                <td class="p-2 space-x-2">
                    <a href="{{ route('contributions.edit', $contribution) }}" class="text-blue-500 hover:underline">Edit</a>
                    <form action="{{ route('contributions.destroy', $contribution) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline ml-2">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection