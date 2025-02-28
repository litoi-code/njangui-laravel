@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 max-w-md mx-auto">
    <h1 class="text-2xl font-bold mb-4">Issue Loan</h1>
    <form action="{{ route('loans.store') }}" method="POST">
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
            <label for="fund_id" class="block text-sm font-medium mb-2">Fund</label>
            <select id="fund_id" name="fund_id" class="border p-2 w-full" required>
                @foreach ($funds as $fund)
                <option value="{{ $fund->id }}">{{ $fund->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="amount" class="block text-sm font-medium mb-2">Loan Amount</label>
            <input type="number" step="0.01" id="amount" name="amount" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="interest_rate" class="block text-sm font-medium mb-2">Interest Rate (%)</label>
            <input type="number" step="0.01" id="interest_rate" name="interest_rate" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="start_date" class="block text-sm font-medium mb-2">Start Date</label>
            <input type="date" id="start_date" name="start_date" class="border p-2 w-full" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Issue Loan</button>
    </form>
</div>
@endsection