@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4">Members</h1>
    <a href="{{ route('members.create') }}" class="bg-blue-500 text-white px-4 py-2 mb-4 inline-block">Add Member</a>
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">Name</th>
                <th class="p-2">Balance</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $member)
            <tr class="border-b">
                <td class="p-2">{{ $member->name }}</td>
                <td class="p-2">${{ number_format($member->balance, 2) }}</td>
                <td class="p-2">
                    <a href="{{ route('members.edit', $member) }}" class="text-blue-500">Edit</a>
                    <form action="{{ route('members.destroy', $member) }}" method="POST" class="inline">
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