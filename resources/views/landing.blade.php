<!-- resources/views/landing.blade.php -->

@extends('layouts.app')

@section('content')
<div class="bg-white">
    <!-- Hero Section -->
    <div class="bg-blue-600 text-white py-20">
        <div class="container mx-auto text-center">
            <h1 class="text-5xl font-bold mb-4">Welcome to the Finance Management System</h1>
            <p class="text-xl mb-8">Efficiently manage funds, contributions, loans, penalties, and transactions for your association.</p>
            <a href="{{ route('members.index') }}" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-blue-50 transition duration-300">Get Started</a>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container mx-auto py-16">
        <h2 class="text-3xl font-bold text-center mb-12">Key Features</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1: Contributions -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-md text-center">
                <div class="text-blue-600 text-4xl mb-4">💰</div>
                <h3 class="text-xl font-bold mb-2">Contributions</h3>
                <p class="text-gray-600">Track and manage member contributions to multiple funds with ease.</p>
                <a href="{{ route('contributions.index') }}" class="text-blue-600 hover:underline mt-4 inline-block">Learn More</a>
            </div>

            <!-- Feature 2: Loans -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-md text-center">
                <div class="text-blue-600 text-4xl mb-4">🏦</div>
                <h3 class="text-xl font-bold mb-2">Loans</h3>
                <p class="text-gray-600">Issue loans with simple interest and track repayments seamlessly.</p>
                <a href="{{ route('loans.index') }}" class="text-blue-600 hover:underline mt-4 inline-block">Learn More</a>
            </div>

            <!-- Feature 3: Penalties -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-md text-center">
                <div class="text-blue-600 text-4xl mb-4">⚠️</div>
                <h3 class="text-xl font-bold mb-2">Penalties</h3>
                <p class="text-gray-600">Assign and manage penalties for late or missed payments.</p>
                <a href="{{ route('penalties.index') }}" class="text-blue-600 hover:underline mt-4 inline-block">Learn More</a>
            </div>
        </div>
    </div>

    <!-- Call to Action Section -->
    <div class="bg-blue-50 py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4">Ready to Get Started?</h2>
            <p class="text-gray-600 mb-8">Join us today and streamline your association's financial management.</p>
            <a href="{{ route('members.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">Explore the System</a>
        </div>
    </div>
</div>
@endsection