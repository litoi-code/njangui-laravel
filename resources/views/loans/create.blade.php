@extends('layouts.app')

@section('content')
<h1 class="mb-3">Create Loan</h1>

<form action="{{ route('loans.store') }}" method="POST" class="mb-4">
    @csrf

    <div class="mb-3">
        <label class="form-label">Borrower (Checking Accounts):</label>
        <select name="source_account_id" class="form-select" required>
            @foreach($accounts->where('type', 'Checking') as $account)
                <option value="{{ $account->id }}">{{ $account->name }} ({{ $account->type }})</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Lender (Investment Accounts):</label>
        <select name="destination_account_id" class="form-select" required>
            @foreach($accounts->where('type', 'Investment') as $account)
                <option value="{{ $account->id }}">{{ $account->name }} ({{ $account->type }})</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Principal Amount:</label>
        <input type="number" name="principal" class="form-control" step="0.01" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Interest Rate (%):</label>
        <input type="number" name="interest_rate" class="form-control" step="0.01" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Loan Term (Months):</label>
        <input type="number" name="loan_term_months" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Start Date:</label>
        <input type="date" name="start_date" class="form-control" value="{{ date('Y-m-d') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Location (Optional):</label>
        <input type="text" name="location" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection