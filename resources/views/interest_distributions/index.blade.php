@extends('layouts.app')

@section('content')
<h2>Interest Distributions</h2>
<table border="1">
    <tr>
        <th>Member</th>
        <th>Fund</th>
        <th>Interest Amount</th>
        <th>Date</th>
    </tr>
    @foreach ($distributions as $distribution)
    <tr>
        <td>{{ $distribution->member->name }}</td>
        <td>{{ $distribution->fund->name }}</td>
        <td>${{ number_format($distribution->interest_amount, 2) }}</td>
        <td>{{ $distribution->date }}</td>
    </tr>
    @endforeach
</table>
@endsection
