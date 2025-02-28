@extends('layouts.app')

@section('title', 'Loan Details')

@section('content')
<div class="container">
    <h1>Loan Details</h1>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Loan Information</h5>
            <p><strong>Member:</strong> {{ $loan->member->name }}</p>
            <p><strong>Fund:</strong> {{ $loan->fund->name }}</p>
            <p><strong>Principal:</strong> {{ $loan->principal }}</p>
            <p><strong>Balance:</strong> {{ $loan->balance }}</p>
            <p><strong>Interest Rate:</strong> {{ $loan->interest_rate }}%</p>
            <p><strong>Start Date:</strong> {{ $loan->start_date }}</p>
            <p><strong>Status:</strong> {{ $loan->is_repaid ? 'Repaid' : 'Pending' }}</p>
        </div>
    </div>

    <!-- Repayment Form -->
    <h2>Make a Repayment</h2>
    <form action="{{ route('loans.repay', $loan->id) }}" method="POST" class="mb-4">
    @csrf
    <div class="mb-4">
        <label for="amount" class="block text-gray-700">Repayment Amount</label>
        <input type="number" name="amount" id="amount" class="border p-2 rounded w-full">
    </div>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Repay</button>
</form>

    <!-- Repayment History -->
    <h2 class="mt-5">Repayment History</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loan->repayments as $repayment)
                <tr>
                    <td>{{ $repayment->date }}</td>
                    <td>{{ $repayment->amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection