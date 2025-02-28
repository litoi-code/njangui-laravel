@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4">Funds</h1>
    <a href="{{ route('funds.create') }}" class="bg-blue-500 text-white px-4 py-2 mb-4 inline-block">Add Fund</a>
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">Name</th>
                <th class="p-2">Type</th>
                <th class="p-2">Balance</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($funds as $fund)
            <tr class="border-b">
                <td class="p-2">{{ $fund->name }}</td>
                <td class="p-2">{{ ucfirst($fund->type) }}</td>
                <td class="p-2">${{ number_format($fund->balance, 2) }}</td>
                <td class="p-2">
                    <a href="{{ route('funds.edit', $fund) }}" class="text-blue-500">Edit</a>
                    <form action="{{ route('funds.destroy', $fund) }}" method="POST" class="inline">
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