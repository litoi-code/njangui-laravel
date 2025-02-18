@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Transfer</h1>
    <form action="{{ route('transfers.update', $transfer->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="type">Transfer Type</label>
            <select name="type" id="type" class="form-control" required>
                <option value="regular" {{ $transfer->type === 'regular' ? 'selected' : '' }}>Regular Transfer</option>
                <option value="distributed" {{ $transfer->type === 'distributed' ? 'selected' : '' }}>Distributed Transfer</option>
            </select>
        </div>
        <div class="form-group">
            <label for="source_account_id">Source Account</label>
            <select name="source_account_id" id="source_account_id" class="form-control" required>
                @foreach ($checkingAccounts as $account)
                    <option value="{{ $account->id }}" {{ $transfer->source_account_id === $account->id ? 'selected' : '' }}>
                        {{ $account->name }} ({{ $account->type }})
                    </option>
                @endforeach
            </select>
        </div>
        <div id="regular-transfer" style="{{ $transfer->type === 'regular' ? 'display: block;' : 'display: none;' }}">
            <div class="form-group">
                <label for="destination_account_id">Destination Account</label>
                <select name="destination_account_id" id="destination_account_id" class="form-control">
                    @foreach ($accounts as $account)
                        <option value="{{ $account->id }}" {{ $transfer->type === 'regular' && $transfer->details['destination_account_id'] === $account->id ? 'selected' : '' }}>
                            {{ $account->name }} ({{ $account->type }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" name="amount" id="amount" class="form-control" value="{{ $transfer->type === 'regular' ? $transfer->amount : '' }}" step="0.01">
            </div>
        </div>
        <div id="distributed-transfer" style="{{ $transfer->type === 'distributed' ? 'display: block;' : 'display: none;' }}">
            <div class="form-group">
                <label>Destinations</label>
                <div id="destinations">
                    @foreach ($savingsInvestmentAccounts as $account)
                        <div class="destination">
                            <input type="hidden" name="destinations[{{ $loop->index }}][account_id]" value="{{ $account->id }}">
                            <label>{{ $account->name }} ({{ $account->type }})</label>
                            <input type="number" name="destinations[{{ $loop->index }}][amount]" class="form-control" value="{{ $transfer->type === 'distributed' ? ($transfer->details[$loop->index]['amount'] ?? 0) : 0 }}" step="0.01">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="transfer_date">Transfer Date</label>
            <input type="date" name="transfer_date" id="transfer_date" class="form-control" value="{{ $transfer->transfer_date }}" required>
        </div>
        <div class="form-group">
            <label for="location">Location (Optional)</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ $transfer->location }}">
        </div>
        <button type="submit" class="btn btn-primary">Update Transfer</button>
    </form>
</div>
<script>
    document.getElementById('type').addEventListener('change', function () {
        const regularTransfer = document.getElementById('regular-transfer');
        const distributedTransfer = document.getElementById('distributed-transfer');
        if (this.value === 'regular') {
            regularTransfer.style.display = 'block';
            distributedTransfer.style.display = 'none';
        } else {
            regularTransfer.style.display = 'none';
            distributedTransfer.style.display = 'block';
        }
    });
</script>
@endsection