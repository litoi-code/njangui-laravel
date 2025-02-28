@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Fund Details</h2>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $fund->name }}</h4>
            <p><strong>Type:</strong> {{ $fund->type }}</p>
            <p><strong>Balance:</strong> ${{ number_format($fund->balance, 2) }}</p>
        </div>
    </div>

    <a href="{{ route('funds.index') }}" class="btn btn-secondary mt-3">Back to Funds</a>
</div>
@endsection
