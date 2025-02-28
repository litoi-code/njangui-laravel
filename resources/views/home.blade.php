@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h1 class="text-3xl font-bold text-center mb-6">Association des Hommes Dynamiques du Village de Koumoul</h1>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Members -->
        <div class="bg-blue-500 text-white p-6 rounded-lg text-center">
            <h2 class="text-xl font-bold">Total Members</h2>
            <p class="text-4xl font-bold">{{ $totalMembers }}</p>
        </div>

        <!-- Total Funds -->
        <div class="bg-green-500 text-white p-6 rounded-lg text-center">
            <h2 class="text-xl font-bold">Total Funds</h2>
            <p class="text-4xl font-bold">{{ $totalFunds }}</p>
        </div>

        <!-- Total Contributions -->
        <div class="bg-yellow-500 text-white p-6 rounded-lg text-center">
            <h2 class="text-xl font-bold">Total Contributions</h2>
            <p class="text-4xl font-bold">${{ number_format($totalContributions, 2) }}</p>
        </div>
    </div>

    <!-- Navigation Links -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Members -->
        <a href="{{ route('members.index') }}" class="bg-blue-100 hover:bg-blue-200 p-6 rounded-lg text-center transition duration-300">
            <h2 class="text-xl font-bold text-blue-700">Manage Members</h2>
            <p class="text-gray-600">Add, edit, or view members of the association.</p>
        </a>

        <!-- Funds -->
        <a href="{{ route('funds.index') }}" class="bg-green-100 hover:bg-green-200 p-6 rounded-lg text-center transition duration-300">
            <h2 class="text-xl font-bold text-green-700">Manage Funds</h2>
            <p class="text-gray-600">Track checking, saving, and investment funds.</p>
        </a>

        <!-- Contributions -->
        <a href="{{ route('contributions.index') }}" class="bg-yellow-100 hover:bg-yellow-200 p-6 rounded-lg text-center transition duration-300">
            <h2 class="text-xl font-bold text-yellow-700">Manage Contributions</h2>
            <p class="text-gray-600">Record and track member contributions.</p>
        </a>

        <!-- Loans -->
        <a href="{{ route('loans.index') }}" class="bg-red-100 hover:bg-red-200 p-6 rounded-lg text-center transition duration-300">
            <h2 class="text-xl font-bold text-red-700">Manage Loans</h2>
            <p class="text-gray-600">Issue loans and track repayments.</p>
        </a>

        <!-- Penalties -->
        <a href="{{ route('penalties.index') }}" class="bg-purple-100 hover:bg-purple-200 p-6 rounded-lg text-center transition duration-300">
            <h2 class="text-xl font-bold text-purple-700">Manage Penalties</h2>
            <p class="text-gray-600">Assign and track penalties for late payments.</p>
        </a>

        <!-- Transactions -->
        <a href="{{ route('transactions.index') }}" class="bg-gray-100 hover:bg-gray-200 p-6 rounded-lg text-center transition duration-300">
            <h2 class="text-xl font-bold text-gray-700">View Transactions</h2>
            <p class="text-gray-600">View all financial transactions in one place.</p>
        </a>
    </div>
</div>
@endsection