@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-header bg-primary text-white">
                Total Account Balance
            </div>
            <div class="card-body">
                <h5 class="card-title">${{ number_format($totalAccountBalance, 2) }}</h5>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-header bg-success text-white">
                Total Transferred Amount
            </div>
            <div class="card-body">
                <h5 class="card-title">${{ number_format($totalTransferredAmount, 2) }}</h5>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-header bg-danger text-white">
                Total Loan Repayment
            </div>
            <div class="card-body">
                <h5 class="card-title">${{ number_format($totalLoanRepayment, 2) }}</h5>
            </div>
        </div>
    </div>
</div>

<div class="mt-4 text-center">
    <a href="{{ route('accounts.index') }}" class="btn btn-primary me-2">Manage Accounts</a>
    <a href="{{ route('transfers.index') }}" class="btn btn-success me-2">View Transfers</a>
    <a href="{{ route('loans.index') }}" class="btn btn-danger">View Loans</a>
</div>
@endsection