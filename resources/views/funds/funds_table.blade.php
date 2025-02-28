<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Balance</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($funds as $fund)
            <tr>
                <td>{{ $fund->name }}</td>
                <td>{{ $fund->balance }}</td>
                <td>
                    <a href="{{ route('funds.edit', $fund->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('funds.destroy', $fund->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center">No funds found.</td>
            </tr>
        @endforelse
    </tbody>
</table>