@extends('layouts.app')

@section('content')
<h1 class="mb-3">Create Account</h1>

<form action="{{ route('accounts.store') }}" method="POST" class="mb-4">
    @csrf

    <div class="mb-3">
        <label class="form-label">Name:</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Type:</label>
        <select name="type" class="form-select" required>
            <option value="Checking">Checking</option>
            <option value="Savings">Savings</option>
            <option value="Investment">Investment</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Balance (Optional):</label>
        <input type="number" name="balance" class="form-control" step="0.01">
    </div>

    <button type="submit" class="btn btn-primary">Create Account</button>
</form>
@endsection