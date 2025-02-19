@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Association Des Hommes Dynamiques du Village Koumoul</h1>
    <div class="text-center">
        <a href="{{ route('accounts.index') }}" class="btn btn-primary me-2">Manage Accounts</a>
        <a href="{{ route('transfers.index') }}" class="btn btn-success me-2">View Transfers</a>
        <a href="{{ route('loans.index') }}" class="btn btn-danger">View Loans</a>
    </div>

    <!-- Savings Accounts -->
    @if ($savingsAccounts->isNotEmpty())
        <div class="row mb-4">
            <div class="col-12">
                <h3 class="text-success mb-3">Savings Accounts</h3>
            </div>
            @foreach ($savingsAccounts as $account)
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            {{ $account->name }}
                        </div>
                        <div class="card-body">
                            <p class="card-text"><strong>Balance:</strong> ${{ number_format($account->balance, 2) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info mb-4">No Savings accounts available.</div>
    @endif

    <!-- Investment Accounts -->
    @if ($investmentAccounts->isNotEmpty())
        <div class="row mb-4">
            <div class="col-12">
                <h3 class="text-info mb-3">Investment Accounts</h3>
            </div>
            @foreach ($investmentAccounts as $account)
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            {{ $account->name }}
                        </div>
                        <div class="card-body">
                            <p class="card-text"><strong>Balance:</strong> ${{ number_format($account->balance, 2) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info mb-4">No Investment accounts available.</div>
    @endif

    <!-- Total Loan Repayment -->
    <div class="card mb-4">
        <div class="card-header bg-danger text-white">
            Total Loan Repayment
        </div>
        <div class="card-body">
            <h5 class="card-title">${{ number_format(\App\Models\Loan::sum('total_repayment'), 2) }}</h5>
        </div>
    </div>

    <!-- Navigation Links -->
    {{-- <div class="text-center">
        <a href="{{ route('accounts.index') }}" class="btn btn-primary me-2">Manage Accounts</a>
        <a href="{{ route('transfers.index') }}" class="btn btn-success me-2">View Transfers</a>
        <a href="{{ route('loans.index') }}" class="btn btn-danger">View Loans</a>
    </div> --}}
</div>
@endsection