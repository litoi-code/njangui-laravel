@extends('layouts.app')

@section('content')
<h1 class="mb-3">Transfers</h1>
<h2 class="mb-4 d-flex justify-content-between align-items-center">
    <span>Total Transfers: <span id="transfer-count">{{ $transfers->count() }}</span></span>
    <a href="{{ route('transfers.create') }}" class="btn btn-success">Create New Transfer</a>
</h2>

<div class="input-group mb-3">
    <input type="text" id="transfer-search" class="form-control" placeholder="Search by source or destination account..." onkeyup="searchTransfers()">
    <button class="btn btn-primary" type="button" onclick="clearSearch()">Clear</button>
</div>

<table class="table table-striped table-bordered" id="transfer-table">
    <thead class="table-dark">
        <tr>
            <th>Source Account</th>
            <th>Destination Account</th>
            <th>Amount</th>
            <th>Transfer Date</th>
            <th>Location</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transfers as $transfer)
            <tr>
                <td>{{ $transfer->sourceAccount->name }} ({{ $transfer->sourceAccount->type }})</td>
                <td>{{ $transfer->destinationAccount->name }} ({{ $transfer->destinationAccount->type }})</td>
                <td>{{ number_format($transfer->amount, 2) }} FCFA</td>
                <td>{{ $transfer->transfer_date }}</td>
                <td>{{ $transfer->location ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('transfers.edit', $transfer->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('transfers.destroy', $transfer->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


<script>
    function searchTransfers() {
        const query = document.getElementById('transfer-search').value.toLowerCase();
        const rows = document.querySelectorAll('#transfer-table tbody tr');
        let count = 0;

        rows.forEach(row => {
            const source = row.cells[0].textContent.toLowerCase();
            const destination = row.cells[1].textContent.toLowerCase();

            if (source.includes(query) || destination.includes(query)) {
                row.style.display = '';
                count++;
            } else {
                row.style.display = 'none';
            }
        });

        document.getElementById('transfer-count').textContent = count;
    }

    function clearSearch() {
        document.getElementById('transfer-search').value = '';
        searchTransfers();
    }
</script>
@endsection
