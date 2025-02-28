<!DOCTYPE html>
<html>
<head>
    <title>Contributions Report</title>
</head>
<body>
    <h1>Contributions Report</h1>
    <table border="1">
        <tr>
            <th>Member</th>
            <th>Fund</th>
            <th>Amount</th>
            <th>Date</th>
        </tr>
        @foreach ($contributions as $contribution)
        <tr>
            <td>{{ $contribution->member->name }}</td>
            <td>{{ $contribution->fund->name }}</td>
            <td>Ksh {{ $contribution->amount }}</td>
            <td>{{ $contribution->created_at->format('d M Y') }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
