@extends('layouts.app')

@section('content')
<h1 class="mb-3">Loans</h1>
<h2 class="mb-4 d-flex justify-content-between align-items-center">
    <span>Total Emprunts: <span id="transfer-count">{{ $loans->count() }}</span></span>
    <a href="{{ route('transfers.create') }}" class="btn btn-success">Nouvel Emprunt</a>
</h2>

<div class="input-group mb-3">
    <input type="text" id="loan-search" class="form-control" placeholder="Search by borrower or lender..." onkeyup="searchLoans()">
    <button class="btn btn-primary" type="button" onclick="clearSearch()">Clear</button>
</div>

<table class="table table-striped table-bordered" id="loan-table">
    <thead class="table-dark">
        <tr>
            <th>Borrower</th>
            <th>Lender</th>
            <th>Principal Amount</th>
            <th>Interest Rate (%)</th>
            <th>Loan Term (Months)</th>
            <th>Total Repayment</th>
            <th>Start Date</th>
            <th>Location</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($loans as $loan)
            <tr>
                <td>{{ $loan->sourceAccount->name }} ({{ $loan->sourceAccount->type }})</td>
                <td>{{ $loan->destinationAccount->name }} ({{ $loan->destinationAccount->type }})</td>
                <td>${{ number_format($loan->principal, 2) }}</td>
                <td>{{ $loan->interest_rate }}%</td>
                <td>{{ $loan->loan_term_months }} Months</td>
                <td>${{ number_format($loan->total_repayment, 2) }}</td>
                <td>{{ $loan->start_date }}</td>
                <td>{{ $loan->location ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<!-- Pagination Links -->
<div class="mt-4 d-flex justify-content-center">
    {{ $loans->appends(request()->except('page'))->links() }}
</div>

{{-- <a href="{{ route('loans.create') }}" class="btn btn-success">Create New Loan</a> --}}

<script>
    function searchLoans() {
        const query = document.getElementById('loan-search').value.toLowerCase();
        const rows = document.querySelectorAll('#loan-table tbody tr');
        let count = 0;

        rows.forEach(row => {
            const borrower = row.cells[0].textContent.toLowerCase();
            const lender = row.cells[1].textContent.toLowerCase();

            if (borrower.includes(query) || lender.includes(query)) {
                row.style.display = '';
                count++;
            } else {
                row.style.display = 'none';
            }
        });

        document.getElementById('loan-count').textContent = count;
    }

    function clearSearch() {
        document.getElementById('loan-search').value = '';
        searchLoans();
    }
</script>
@endsection