@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Total Transfers per Destination Account -->
    <h2 class="mb-4 d-flex justify-content-between align-items-center">
        <span>Total Transfers: <span id="transfer-count">{{ $transfers->count() }}</span></span>
        <a href="{{ route('transfers.create') }}" class="btn btn-success">Create New Transfer</a>
    </h2>
    <div class="row mb-4" id="destination-total-cards">
        @if ($transfers->isNotEmpty())
            {{-- <h3 class="text-primary mb-3">Total Transfers per Destination Account</h3> --}}
            @foreach ($transfers->groupBy('destination_account_id') as $destinationId => $groupedTransfers)
                @php
                    $destinationAccount = $accounts->firstWhere('id', $destinationId);
                    $totalAmount = $groupedTransfers->sum('amount');
                @endphp
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            {{ $destinationAccount->name }} ({{ $destinationAccount->type }})
                        </div>
                        <div class="card-body">
                            <p class="card-text"><strong>Total Amount:</strong> {{ number_format($totalAmount, 2) }} FCFA</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-info mb-4">No transfers available.</div>
        @endif
    </div>

    <!-- Search and Date Filters -->
    <div class="row mb-3">
        <!-- Search Input -->
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" id="transfer-search" class="form-control" placeholder="Search by source or destination account..." onkeyup="filterTransfers()">
                <button class="btn btn-primary" type="button" onclick="clearSearch()">Clear</button>
            </div>
        </div>

        <!-- Date Filters -->
        <div class="col-md-6">
            <div class="input-group">
                <label class="input-group-text">Filter by Date:</label>
                <input type="date" id="start-date" class="form-control" onchange="filterTransfers()" placeholder="Start Date">
                <span class="input-group-text">to</span>
                <input type="date" id="end-date" class="form-control" onchange="filterTransfers()" placeholder="End Date">
                <button class="btn btn-primary" type="button" onclick="clearDateFilters()">Clear</button>
            </div>
        </div>
    </div>

    <!-- Transfer Table -->
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
                <tr data-transfer-date="{{ $transfer->transfer_date }}" data-destination-id="{{ $transfer->destination_account_id }}">
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

    <!-- Create New Transfer Button -->
    {{-- <a href="{{ route('transfers.create') }}" class="btn btn-success">Create New Transfer</a> --}}

    <!-- JavaScript for Filtering and Dynamic Updates -->
    <script>
        function filterTransfers() {
            const query = document.getElementById('transfer-search').value.toLowerCase();
            const startDate = document.getElementById('start-date').value;
            const endDate = document.getElementById('end-date').value;

            const rows = document.querySelectorAll('#transfer-table tbody tr');
            let visibleRows = [];

            rows.forEach(row => {
                const source = row.cells[0].textContent.toLowerCase();
                const destination = row.cells[1].textContent.toLowerCase();
                const transferDate = row.getAttribute('data-transfer-date');

                // Check if the row matches the search query
                const matchesSearch = source.includes(query) || destination.includes(query);

                // Check if the row matches the date range
                const matchesDate = (!startDate || transferDate >= startDate) && (!endDate || transferDate <= endDate);

                if (matchesSearch && matchesDate) {
                    row.style.display = '';
                    visibleRows.push(row);
                } else {
                    row.style.display = 'none';
                }
            });

            // Update the total transfers per destination account
            updateDestinationTotals(visibleRows);
        }

        function clearSearch() {
            document.getElementById('transfer-search').value = '';
            filterTransfers();
        }

        function clearDateFilters() {
            document.getElementById('start-date').value = '';
            document.getElementById('end-date').value = '';
            filterTransfers();
        }

        function updateDestinationTotals(visibleRows) {
            const destinationTotals = {};
            const accountsById = @json($accounts->keyBy('id'));

            visibleRows.forEach(row => {
                const destinationId = row.getAttribute('data-destination-id');
                const amount = parseFloat(row.cells[2].textContent.replace('$', '').replace(',', ''));

                if (!destinationTotals[destinationId]) {
                    destinationTotals[destinationId] = 0;
                }
                destinationTotals[destinationId] += amount;
            });

            // Clear existing cards
            const cardContainer = document.getElementById('destination-total-cards');
            cardContainer.innerHTML = '';

            // Add new cards for visible destinations
            if (Object.keys(destinationTotals).length > 0) {
                const header = document.createElement('h3');
                header.className = 'text-primary mb-3';
                header.textContent = 'Total Transfers per Destination Account';
                cardContainer.appendChild(header);

                for (const [destinationId, totalAmount] of Object.entries(destinationTotals)) {
                    const account = accountsById[destinationId];

                    const card = document.createElement('div');
                    card.className = 'col-md-6 col-lg-4 mb-3';

                    const cardDiv = document.createElement('div');
                    cardDiv.className = 'card';

                    const cardHeader = document.createElement('div');
                    cardHeader.className = 'card-header bg-primary text-white';
                    cardHeader.textContent = `${account.name} (${account.type})`;

                    const cardBody = document.createElement('div');
                    cardBody.className = 'card-body';
                    cardBody.innerHTML = `<p class="card-text"><strong>Total Amount:</strong> $${totalAmount.toFixed(2)}</p>`;

                    cardDiv.appendChild(cardHeader);
                    cardDiv.appendChild(cardBody);
                    card.appendChild(cardDiv);
                    cardContainer.appendChild(card);
                }
            } else {
                // Display empty state message
                cardContainer.innerHTML = `<div class="alert alert-info">No transfers available.</div>`;
            }
        }

        // Initial filter call to populate totals
        filterTransfers();
    </script>
</div>
@endsection