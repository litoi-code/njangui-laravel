@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Penalty</h1>
    <form action="{{ route('penalties.update', $penalty->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="member_id">Member</label>
            <select name="member_id" id="member_id" class="form-control" required>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}" {{ $member->id == $penalty->member_id ? 'selected' : '' }}>{{ $member->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" step="0.01" value="{{ $penalty->amount }}" required>
        </div>
        <div class="form-group">
            <label for="reason">Reason</label>
            <input type="text" name="reason" id="reason" class="form-control" value="{{ $penalty->reason }}" required>
        </div>
        <div class="form-group">
            <label for="is_paid">Is Paid?</label>
            <select name="is_paid" id="is_paid" class="form-control" required>
                <option value="0" {{ $penalty->is_paid == 0 ? 'selected' : '' }}>No</option>
                <option value="1" {{ $penalty->is_paid == 1 ? 'selected' : '' }}>Yes</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection