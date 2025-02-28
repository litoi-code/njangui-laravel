@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4">Penalties</h1>
    <a href="{{ route('penalties.create') }}" class="bg-blue-500 text-white px-4 py-2 mb-4 inline-block">Assign Penalty</a>
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">Member</th>
                <th class="p-2">Amount</th>
                <th class="p-2">Reason</th>
                <th class="p-2">Paid</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penalties as $penalty)
            <tr class="border-b">
                <td class="p-2">{{ $penalty->member->name }}</td>
                <td class="p-2">${{ number_format($penalty->amount, 2) }}</td>
                <td class="p-2">{{ $penalty->reason }}</td>
                <td class="p-2">{{ $penalty->paid ? 'Yes' : 'No' }}</td>
                <td class="p-2">
                    @if (!$penalty->paid)
                    <form action="{{ route('penalties.pay', $penalty) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-green-500 text-white px-2 py-1">Pay</button>
                    </form>
                    @endif
                    <form action="{{ route('penalties.destroy', $penalty) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 ml-2">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection