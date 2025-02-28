<table class="w-full border-collapse">
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
        @forelse ($contributions as $contribution)
        <tr class="border-b">
            <td class="p-2">{{ $contribution->member->name }}</td>
            <td class="p-2">{{ $contribution->fund->name }}</td>
            <td class="p-2">${{ number_format($contribution->amount, 2) }}</td>
            <td class="p-2">{{ $contribution->date }}</td>
            <td class="p-2">{{ $contribution->host ?? '-' }}</td>
            <td class="p-2 space-x-2">
                <a href="{{ route('contributions.edit', $contribution) }}" class="text-green-500 hover:underline">Edit</a>
                <form action="{{ route('contributions.destroy', $contribution) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline ml-2">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="p-2 text-center text-gray-500">No contributions found.</td>
        </tr>
        @endforelse
    </tbody>
</table>