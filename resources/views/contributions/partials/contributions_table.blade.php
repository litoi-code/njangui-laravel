<table class="table table-bordered">
    <thead>
        <tr>
            <th>Member</th>
            <th>Fund</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($contributions as $contribution)
            <tr>
                <td>{{ $contribution->member->name }}</td>
                <td>{{ $contribution->fund->name }}</td>
                <td>{{ $contribution->amount }}</td>
                <td>{{ $contribution->date }}</td>
                <td>
                    <a href="{{ route('contributions.edit', $contribution->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('contributions.destroy', $contribution->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">No contributions found.</td>
            </tr>
        @endforelse
    </tbody>
</table>