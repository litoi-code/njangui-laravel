@extends('layouts.app')

@section('content')
<h2 class="mb-4 d-flex justify-content-between align-items-center">
    <span>Total: <span id="account-count">{{ $accounts->count() }}</span></span>
    <a href="{{ route('accounts.create') }}" class="btn btn-success">Nouveau Compte</a>
</h2>

<div class="input-group mb-3">
    <input type="text" id="account-search" class="form-control" placeholder="Search by name..." onkeyup="searchAccounts()">
    <button class="btn btn-primary" type="button" onclick="clearSearch()">Clear</button>
</div>

<table class="table table-striped table-bordered" id="account-table">
    <thead class="table-dark">
        <tr>
            <th>Nom</th>
            <th>Type</th>
            <th>Balance</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($accounts as $account)
            <tr>
                <td>{{ $account->name }}</td>
                <td>{{ $account->type }}</td>
                <td>${{ number_format($account->balance, 2) }}</td>
                <td>
                    <a href="{{ route('accounts.edit', $account->id) }}" class="btn btn-sm btn-primary">Editer</a>
                    <form action="{{ route('accounts.destroy', $account->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<!-- Pagination Links -->
<div class="mt-4 d-flex justify-content-center">
    {{ $accounts->appends(request()->except('page'))->links() }}
</div>

<script>
    function searchAccounts() {
        const query = document.getElementById('account-search').value.toLowerCase();
        const rows = document.querySelectorAll('#account-table tbody tr');
        let count = 0;

        rows.forEach(row => {
            const name = row.cells[0].textContent.toLowerCase();
            if (name.includes(query)) {
                row.style.display = '';
                count++;
            } else {
                row.style.display = 'none';
            }
        });

        document.getElementById('account-count').textContent = count;
    }

    function clearSearch() {
        document.getElementById('account-search').value = '';
        searchAccounts();
    }
</script>
@endsection