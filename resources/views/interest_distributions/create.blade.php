@extends('layouts.app')

@section('content')
<h2>Distribute Interest</h2>
<form action="{{ route('interest-distributions.store') }}" method="POST">
    @csrf
    <label for="fund_id">Fund:</label>
    <select name="fund_id">
        <option value="1">Savings Fund</option>
    </select>
    <br>

    <label for="total_interest">Total Interest:</label>
    <input type="number" name="total_interest" required>
    <br>

    <label for="date">Date:</label>
    <input type="date" name="date" required>
    <br>

    <button type="submit">Distribute Interest</button>
</form>
@endsection
