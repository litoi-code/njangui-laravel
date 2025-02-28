@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 max-w-md mx-auto">
    <h1 class="text-2xl font-bold mb-4">Edit Fund</h1>
    <form action="{{ route('funds.update', $fund) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Name Field -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium mb-2">Name</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                value="{{ old('name', $fund->name) }}" 
                class="border p-2 w-full @error('name') border-red-500 @enderror" 
                required
            >
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Type Field -->
        <div class="mb-4">
            <label for="type" class="block text-sm font-medium mb-2">Type</label>
            <select 
                id="type" 
                name="type" 
                class="border p-2 w-full @error('type') border-red-500 @enderror" 
                required
            >
                <option value="checking" {{ old('type', $fund->type) === 'checking' ? 'selected' : '' }}>Checking</option>
                <option value="saving" {{ old('type', $fund->type) === 'saving' ? 'selected' : '' }}>Saving</option>
                <option value="investment" {{ old('type', $fund->type) === 'investment' ? 'selected' : '' }}>Investment</option>
            </select>
            @error('type')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Balance Field (Readonly) -->
        <div class="mb-4">
            <label for="balance" class="block text-sm font-medium mb-2">Balance</label>
            <input 
                type="text" 
                id="balance" 
                value="${{ number_format($fund->balance, 2) }}" 
                readonly 
                class="border p-2 w-full bg-gray-100 cursor-not-allowed"
            >
        </div>

        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Update Fund</button>
    </form>
</div>
@endsection