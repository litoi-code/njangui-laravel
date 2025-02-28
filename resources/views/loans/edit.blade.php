@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Loan</h2>

    <form action="{{ route('loans.update', $loan->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label for="member_id" class="form-label">Member</label>
            <select class="form-control" name="member_id" required>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}" {{ $loan->member_id == $member->id ? 'selected' : '' }}>
                        {{ $member->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Loan Amount</label>
            <input type="number" class="form-control" name="amount" value="{{ $loan->amount }}" required>
        </div>

        <div class="mb-3">
            <label for="interest_rate" class="form-label">Interest Rate (%)</label>
            <input type="number" class="form-control" name="interest_rate" value="{{ $loan->interest_rate }}" step="0.1" required>
        </div>

        <div class="mb-3">
            <label for="term" class="form-label">Loan Term (Months)</label>
            <input type="number" class="form-control" name="term" value="{{ $loan->term }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update Loan</button>
        <a href="{{ route('loans.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
