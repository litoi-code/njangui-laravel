@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Financial Summary</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Category</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Contributions</td>
                <td>${{ number_format($total_contributions, 2) }}</td>
            </tr>
            <tr>
                <td>Penalties</td>
                <td>${{ number_format($total_penalties, 2) }}</td>
            </tr>
            <tr>
                <td>Deposits</td>
                <td>${{ number_format($total_deposits, 2) }}</td>
            </tr>
            <tr>
                <td>Loans Issued</td>
                <td>${{ number_format($total_loans, 2) }}</td>
            </tr>
            <tr>
                <td>Interest Distributed</td>
                <td>${{ number_format($total_interest_distributed, 2) }}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
