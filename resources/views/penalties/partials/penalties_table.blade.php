<table class="table table-bordered">
    <thead>
        <tr>
            <th>Member</th>
            <th>Amount</th>
            <th>Reason</th>
            <th>Paid</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($penalties as $penalty)
            <tr>
                <td>{{ $penalty->member->name }}</td>
                <td>{{ $penalty->amount }}</td>
                <td>{{ $penalty->reason }}</td>
                <td>{{ $penalty->is_paid ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('penalties.edit', $penalty->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('penalties.destroy', $penalty->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">No penalties found.</td>
            </tr>
        @endforelse
    </tbody>
</table>