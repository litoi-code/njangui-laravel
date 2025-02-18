@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Loan</h1>
    <form action="{{ route('loans.update', $loan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="account_id">Lender Account (Investment)</label>
            <select name="account_id" id="account_id" class="form-control" required>
                @foreach ($investmentAccounts as $account)
                    <option value="{{ $account->id }}" {{ $loan->account_id === $account->id ? 'selected' : '' }}>
                        {{ $account->name }} ({{ $account->type }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="borrower_account_id">Borrower Account (Checking)</label>
            <select name="borrower_account_id" id="borrower_account_id" class="form-control" required>
                @foreach ($checkingAccounts as $account)
                    <option value="{{ $account->id }}" {{ $loan->borrower_account_id === $account->id ? 'selected' : '' }}>
                        {{ $account->name }} ({{ $account->type }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="principal_amount">Principal Amount</label>
            <input type="number" name="principal_amount" id="principal_amount" class="form-control" value="{{ $loan->principal_amount }}" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="interest_rate">Interest Rate (%)</label>
            <input type="number" name="interest_rate" id="interest_rate" class="form-control" value="{{ $loan->interest_rate }}" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="loan_term">Loan Term (Months)</label>
            <input type="number" name="loan_term" id="loan_term" class="form-control" value="{{ $loan->loan_term }}" required>
        </div>
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $loan->start_date }}" required>
        </div>
        <div class="form-group">
            <label for="location">Location (Optional)</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ $loan->location }}">
        </div>
        <button type="submit" class="btn btn-primary">Update Loan</button>
    </form>
</div>
@endsection