<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fund Transfer & Loan Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <nav class="bg-blue-600 p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-white text-xl font-bold">Fund Tracker</h1>
            <ul class="flex space-x-4">
                <li><a href="{{ route('home') }}" class="text-white hover:underline">Home</a></li>
                <li><a href="{{ route('accounts.index') }}" class="text-white hover:underline">Accounts</a></li>
                <li><a href="{{ route('transfers.index') }}" class="text-white hover:underline">Transfers</a></li>
                <li><a href="{{ route('loans.index') }}" class="text-white hover:underline">Loans</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mx-auto text-center mt-10">
        <h1 class="text-4xl font-bold text-blue-600">Welcome to the Fund Transfer & Loan Management System</h1>
        <p class="mt-4 text-gray-600">Manage your accounts, transfers, and loans efficiently.</p>
        <a href="{{ route('accounts.index') }}" class="mt-6 inline-block px-6 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
            Get Started
        </a>
    </div>

</body>
</html>
