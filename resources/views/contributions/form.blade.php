<div class="mb-3">
    <label for="member_id" class="form-label">Member</label>
    <select class="form-control" name="member_id" required>
        @foreach($members as $member)
            <option value="{{ $member->id }}" {{ isset($contribution) && $contribution->member_id == $member->id ? 'selected' : '' }}>
                {{ $member->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="fund_id" class="form-label">Fund</label>
    <select class="form-control" name="fund_id" required>
        @foreach($funds as $fund)
            <option value="{{ $fund->id }}" {{ isset($contribution) && $contribution->fund_id == $fund->id ? 'selected' : '' }}>
                {{ $fund->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="amount" class="form-label">Amount</label>
    <input type="number" class="form-control" name="amount" value="{{ $contribution->amount ?? old('amount') }}" required>
</div>

<div class="mb-3">
    <label for="host" class="form-label">Host</label>
    <input type="text" class="form-control" name="host" value="{{ $contribution->host ?? old('host') }}" required>
</div>

<div class="mb-3">
    <label for="location" class="form-label">Location</label>
    <input type="text" class="form-control" name="location" value="{{ $contribution->location ?? old('location') }}" required>
</div>
