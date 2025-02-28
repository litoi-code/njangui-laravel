<div class="modal fade" id="transferModal" tabindex="-1" aria-labelledby="transferModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Transfer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="transferForm">
                    @csrf
                    <div class="mb-3">
                        <label for="transfer_type" class="form-label">Transfer Type</label>
                        <select class="form-control" id="transfer_type" name="transfer_type" required>
                            <option value="Regular">Regular</option>
                            <option value="Distributed">Distributed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="source_account_id" class="form-label">Source Account</label>
                        <select class="form-control" id="source_account_id" name="source_account_id" required>
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}">{{ $account->name }} ({{ $account->balance }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="destination_account_id" class="form-label">Destination Account</label>
                        <select class="form-control" id="destination_account_id" name="destination_account_id">
                            <option value="">Select Destination (if applicable)</option>
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}">{{ $account->name }} ({{ $account->balance }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount" required>
                    </div>
                    <div class="mb-3">
                        <label for="transfer_date" class="form-label">Transfer Date</label>
                        <input type="date" class="form-control" id="transfer_date" name="transfer_date" value="{{ now()->toDateString() }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location (Optional)</label>
                        <input type="text" class="form-control" id="location" name="location">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Transfer</button>
                </form>
            </div>
        </div>
    </div>
</div>
