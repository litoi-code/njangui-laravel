@extends('layouts.app')

@section('content')
<h1 class="mb-3">Edit Account</h1>

<form action="{{ route('accounts.update', $account->id) }}" method="POST" class="mb-4">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Name:</label>
        <input type="text" name="name" class="form-control" value="{{ $account->name }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Type:</label>
        <select name="type" class="form-select" required>
            <option value="Checking" {{ $account->type === 'Checking' ? 'selected' : '' }}>Checking</option>
            <option value="Savings" {{ $account->type === 'Savings' ? 'selected' : '' }}>Savings</option>
            <option value="Investment" {{ $account->type === 'Investment' ? 'selected' : '' }}>Investment</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Balance:</label>
        <input type="number" name="balance" class="form-control" value="{{ $account->balance }}" step="0.01" required>
    </div>

    <button type="submit" class="btn btn-primary">Update Account</button>
</form>
@endsection