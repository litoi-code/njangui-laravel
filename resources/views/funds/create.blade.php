@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 max-w-md mx-auto">
    <h1 class="text-2xl font-bold mb-4">Add Fund</h1>
    <form action="{{ route('funds.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium mb-2">Name</label>
            <input type="text" id="name" name="name" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="type" class="block text-sm font-medium mb-2">Type</label>
            <select id="type" name="type" class="border p-2 w-full" required>
                <option value="checking">Checking</option>
                <option value="saving">Saving</option>
                <option value="investment">Investment</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Save</button>
    </form>
</div>
@endsection