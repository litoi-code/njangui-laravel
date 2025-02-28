@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 max-w-md mx-auto">
    <h1 class="text-2xl font-bold mb-4">Assign Penalty</h1>
    <form action="{{ route('penalties.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="member_id" class="block text-sm font-medium mb-2">Member</label>
            <select id="member_id" name="member_id" class="border p-2 w-full" required>
                @foreach ($members as $member)
                <option value="{{ $member->id }}">{{ $member->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="amount" class="block text-sm font-medium mb-2">Penalty Amount</label>
            <input type="number" step="0.01" id="amount" name="amount" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="reason" class="block text-sm font-medium mb-2">Reason</label>
            <textarea id="reason" name="reason" rows="3" class="border p-2 w-full" required></textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Assign Penalty</button>
    </form>
</div>
@endsection