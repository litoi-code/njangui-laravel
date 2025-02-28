<!-- resources/views/transactions/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4">{{ isset($transaction) ? 'Edit Transaction' : 'Add Transaction' }}</h1>
    <form action="{{ isset($transaction) ? route('transactions.update', $transaction->id) : route('transactions.store') }}" method="POST">
        @csrf
        @if (isset($transaction))
            @method('PUT')
        @endif

        <div class="mb-4">
            <label for="member_id" class="block text-gray-700">Member</label>
            <select name="member_id" id="member_id" class="border p-2 rounded w-full">
                @foreach ($members as $member)
                    <option value="{{ $member->id }}" {{ (isset($transaction) && $transaction->member_id == $member->id) ? 'selected' : '' }}>
                        {{ $member->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="fund_id" class="block text-gray-700">Fund</label>
            <select name="fund_id" id="fund_id" class="border p-2 rounded w-full">
                <option value="">Select Fund (Optional)</option>
                @foreach ($funds as $fund)
                    <option value="{{ $fund->id }}" {{ (isset($transaction) && $transaction->fund_id == $fund->id) ? 'selected' : '' }}>
                        {{ $fund->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="type" class="block text-gray-700">Type</label>
            <input type="text" name="type" id="type" value="{{ isset($transaction) ? $transaction->type : old('type') }}" class="border p-2 rounded w-full">
        </div>

        <div class="mb-4">
            <label for="amount" class="block text-gray-700">Amount</label>
            <input type="number" name="amount" id="amount" value="{{ isset($transaction) ? $transaction->amount : old('amount') }}" class="border p-2 rounded w-full">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <textarea name="description" id="description" class="border p-2 rounded w-full">{{ isset($transaction) ? $transaction->description : old('description') }}</textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            {{ isset($transaction) ? 'Update' : 'Create' }}
        </button>
    </form>
</div>
@endsection