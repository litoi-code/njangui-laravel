@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 max-w-md mx-auto">
    <h1 class="text-2xl font-bold mb-4">Edit Contribution</h1>
    <form action="{{ route('contributions.update', $contribution) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Member Dropdown -->
        <div class="mb-4">
            <label for="member_id" class="block text-sm font-medium mb-2">Member</label>
            <select id="member_id" name="member_id" class="border p-2 w-full" required>
                @foreach ($members as $member)
                <option value="{{ $member->id }}" {{ $contribution->member_id == $member->id ? 'selected' : '' }}>
                    {{ $member->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Fund Dropdown -->
        <div class="mb-4">
            <label for="fund_id" class="block text-sm font-medium mb-2">Fund</label>
            <select id="fund_id" name="fund_id" class="border p-2 w-full" required>
                @foreach ($funds as $fund)
                <option value="{{ $fund->id }}" {{ $contribution->fund_id == $fund->id ? 'selected' : '' }}>
                    {{ $fund->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Amount Input -->
        <div class="mb-4">
            <label for="amount" class="block text-sm font-medium mb-2">Amount</label>
            <input type="number" step="0.01" id="amount" name="amount" value="{{ $contribution->amount }}" class="border p-2 w-full" required>
        </div>

        <!-- Date Input -->
        <div class="mb-4">
            <label for="date" class="block text-sm font-medium mb-2">Date</label>
            <input type="date" id="date" name="date" value="{{ $contribution->date }}" class="border p-2 w-full" required>
        </div>

        <!-- Host Dropdown -->
        <div class="mb-4">
            <label for="host" class="block text-sm font-medium mb-2">Host (Optional)</label>
            <select id="host" name="host" class="border p-2 w-full">
                <option value="">None</option>
                @foreach ($members as $member)
                <option value="{{ $member->name }}" {{ $contribution->host == $member->name ? 'selected' : '' }}>
                    {{ $member->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Update Contribution</button>
    </form>
</div>
@endsection