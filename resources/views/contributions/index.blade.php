@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4">Contributions</h1>

    <!-- Search Input -->
    <div class="mb-4">
        <input 
            type="text" 
            id="searchInput" 
            placeholder="Search contributions..." 
            class="border p-2 w-full"
        >
    </div>

    <!-- Total Balance Per Fund -->
    <h2 class="text-xl font-bold mb-4">Total Balance Per Fund</h2>
    <div id="fundBalancesGrid" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        @foreach ($funds as $fund)
        <div class="bg-gray-100 p-4 rounded-lg text-center">
            <h3 class="font-bold mb-2">{{ $fund->name }} ({{ ucfirst($fund->type) }})</h3>
            <p class="text-2xl font-bold">${{ number_format($fund->balance, 2) }}</p>
        </div>
        @endforeach
    </div>

    <!-- Add Contribution Button -->
    <a href="{{ route('contributions.create') }}" class="bg-blue-500 text-white px-4 py-2 mb-4 inline-block">Add Contribution</a>

    <!-- Contributions Table -->
    <table id="contributionsTable" class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">Member</th>
                <th class="p-2">Fund</th>
                <th class="p-2">Amount</th>
                <th class="p-2">Date</th>
                <th class="p-2">Host</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contributions as $contribution)
            <tr class="border-b">
                <td class="p-2">{{ $contribution->member->name }}</td>
                <td class="p-2">{{ $contribution->fund->name }}</td>
                <td class="p-2">${{ number_format($contribution->amount, 2) }}</td>
                <td class="p-2">{{ $contribution->date }}</td>
                <td class="p-2">{{ $contribution->host ?? '-' }}</td>
                <td class="p-2 space-x-2">
                    <a href="{{ route('contributions.edit', $contribution) }}" class="text-blue-500 hover:underline">Edit</a>
                    <form action="{{ route('contributions.destroy', $contribution) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline ml-2">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- JavaScript for Real-Time Search -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const contributionsTable = document.getElementById('contributionsTable');
    const fundBalancesGrid = document.getElementById('fundBalancesGrid');

    // Function to perform AJAX search
    function performSearch(query) {
        fetch(`/contributions/search?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                // Update the contributions table
                const tbody = contributionsTable.querySelector('tbody');
                tbody.innerHTML = ''; // Clear existing rows

                if (data.contributions.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="7" class="text-center">No contributions found.</td></tr>';
                } else {
                    data.contributions.forEach(contribution => {
                        const row = `
                            <tr class="border-b">
                                <td class="p-2">${contribution.member_name}</td>
                                <td class="p-2">${contribution.fund_name}</td>
                                <td class="p-2">$${parseFloat(contribution.amount).toFixed(2)}</td>
                                <td class="p-2">${contribution.date}</td>
                                <td class="p-2">${contribution.host || '-'}</td>
                                <td class="p-2 space-x-2">
                                    <a href="/contributions/${contribution.id}/edit" class="text-blue-500 hover:underline">Edit</a>
                                    <form action="/contributions/${contribution.id}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline ml-2">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        `;
                        tbody.insertAdjacentHTML('beforeend', row);
                    });
                }

                // Update the total fund balances
                fundBalancesGrid.innerHTML = ''; // Clear existing fund cards
                data.fundBalances.forEach(fund => {
                    const card = `
                        <div class="bg-gray-100 p-4 rounded-lg text-center">
                            <h3 class="font-bold mb-2">${fund.name} (${fund.type})</h3>
                            <p class="text-2xl font-bold">$${parseFloat(fund.balance).toFixed(2)}</p>
                        </div>
                    `;
                    fundBalancesGrid.insertAdjacentHTML('beforeend', card);
                });
            })
            .catch(error => console.error('Error fetching search results:', error));
    }

    // Attach event listener to search input
    searchInput.addEventListener('input', function () {
        const query = this.value.trim();
        performSearch(query);
    });
});
</script>
@endsection