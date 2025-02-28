@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Transaction</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label for="member_id" class="form-label">Member</label>
            <select class="form-control" name="member_id" required>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}" {{ $transaction->member_id == $member->id ? 'selected' : '' }}>
                        {{ $member->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="fund_id" class="form-label">Fund</label>
            <select class="form-control" name="fund_id" required>
                @foreach ($funds as $fund)
                    <option value="{{ $fund->id }}" {{ $transaction->fund_id == $fund->id ? 'selected' : '' }}>
                        {{ $fund->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" class="form-control" name="amount" value="{{ $transaction->amount }}" required>
        </div>

        <div class="mb-3">
            <label for="transaction_type" class="form-label">Transaction Type</label>
            <select class="form-control" name="transaction_type" required>
                <option value="contribution" {{ $transaction->transaction_type == 'contribution' ? 'selected' : '' }}>Contribution</option>
                <option value="loan_repayment" {{ $transaction->transaction_type == 'loan_repayment' ? 'selected' : '' }}>Loan Repayment</option>
                <option value="penalty" {{ $transaction->transaction_type == 'penalty' ? 'selected' : '' }}>Penalty Payment</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Transaction Date</label>
            <input type="date" class="form-control" name="date" value="{{ $transaction->date }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update Transaction</button>
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
