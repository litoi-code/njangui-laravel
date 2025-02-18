@extends('layouts.app')

@section('content')
<h1 class="mb-3">Create Transfer</h1>

<div class="alert alert-info mb-3" id="total-amount-alert" style="display: none;">
    <strong>Total Amount to Transfer:</strong> $<span id="total-amount">0.00</span>
</div>

<form action="{{ route('transfers.store') }}" method="POST" class="mb-4">
    @csrf

    <div class="form-check form-check-inline mb-3">
        <input class="form-check-input" type="radio" name="transfer_mode" id="regular" value="regular" checked>
        <label class="form-check-label" for="regular">Regular Transfer</label>
    </div>
    <div class="form-check form-check-inline mb-3">
        <input class="form-check-input" type="radio" name="transfer_mode" id="distributed" value="distributed">
        <label class="form-check-label" for="distributed">Distributed Transfer</label>
    </div>

    <div id="regular-transfer" class="mt-3">
        <div class="mb-3">
            <label class="form-label">Source Account:</label>
            <select name="source_account_id" class="form-select" required>
                @foreach($accounts as $account)
                    <option value="{{ $account->id }}">{{ $account->name }} ({{ $account->type }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Destination Account:</label>
            <select name="destination_account_id" class="form-select" required>
                @foreach($accounts as $account)
                    <option value="{{ $account->id }}">{{ $account->name }} ({{ $account->type }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Amount:</label>
            <input type="number" name="amount" class="form-control" step="0.01" required>
        </div>
    </div>

    <div id="distributed-transfer" class="mt-3" style="display:none;">
        <div class="mb-3">
            <label class="form-label">Source Account (Preselected Checking Accounts):</label>
            <select name="source_account_id" class="form-select" required>
                @foreach($accounts->where('type', 'Checking') as $account)
                    <option value="{{ $account->id }}">{{ $account->name }} ({{ $account->type }})</option>
                @endforeach
            </select>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Account</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($accounts->where('type', '!=', 'Checking') as $account)
                    <tr>
                        <td>{{ $account->name }} ({{ $account->type }})</td>
                        <td>
                            <input type="number" name="distributed_amounts[{{ $account->id }}]" class="form-control distributed-amount" value="0" step="0.01" oninput="updateTotalAmount()">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mb-3">
        <label class="form-label">Transfer Date:</label>
        <input type="date" name="transfer_date" class="form-control" value="{{ date('Y-m-d') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Location (Optional):</label>
        <input type="text" name="location" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>
    document.querySelectorAll('input[name="transfer_mode"]').forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'regular') {
                document.getElementById('regular-transfer').style.display = 'block';
                document.getElementById('distributed-transfer').style.display = 'none';
                document.getElementById('total-amount-alert').style.display = 'none';

                // Enable the 'amount' field for Regular Transfer
                document.querySelector('input[name="amount"]').setAttribute('required', 'true');
            } else {
                document.getElementById('regular-transfer').style.display = 'none';
                document.getElementById('distributed-transfer').style.display = 'block';
                document.getElementById('total-amount-alert').style.display = 'block';

                // Disable the 'amount' field for Distributed Transfer
                document.querySelector('input[name="amount"]').removeAttribute('required');
                updateTotalAmount();
            }
        });
    });

    function updateTotalAmount() {
        let total = 0;
        const amounts = document.querySelectorAll('.distributed-amount');
        amounts.forEach(input => {
            const value = parseFloat(input.value) || 0;
            total += value;
        });

        document.getElementById('total-amount').textContent = total.toFixed(2);

        // Show or hide the alert based on whether any amounts are entered
        if (total > 0) {
            document.getElementById('total-amount-alert').style.display = 'block';
        } else {
            document.getElementById('total-amount-alert').style.display = 'none';
        }
    }

    // Prevent form submission if no valid amounts are entered in Distributed Transfer mode
    document.querySelector('form').addEventListener('submit', function(event) {
        const transferMode = document.querySelector('input[name="transfer_mode"]:checked').value;

        if (transferMode === 'distributed') {
            const totalAmount = parseFloat(document.getElementById('total-amount').textContent);
            if (totalAmount <= 0) {
                event.preventDefault(); // Prevent form submission
                alert('Please enter valid amounts for distributed transfers.');
            }
        }
    });
</script>
@endsection