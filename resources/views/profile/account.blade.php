@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded-xl shadow-md">
    <h2 class="text-2xl font-semibold mb-6">My Account</h2>

    {{-- Info Saat Ini --}}
    <div class="mb-6">
        <p><strong>Current Username:</strong> {{ $user->user_name }}</p>
        <p><strong>Current Email:</strong> {{ $user->email }}</p>
    </div>

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error --}}
    @if($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Update Username --}}
    <form action="{{ route('account.update.username') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="username" class="block font-medium text-gray-700">Username</label>
            <input type="text" name="username" id="username"
                   value="{{ old('username', $user->user_name) }}"
                   class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300">
        </div>
        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Update Username
        </button>
    </form>

    {{-- Update Email --}}
    <form action="{{ route('account.update.email') }}" method="POST" class="space-y-4 mt-8">
        @csrf
        <div>
            <label for="email" class="block font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email"
                   value="{{ old('email', $user->email) }}"
                   class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300">
        </div>
        <button type="submit"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
            Update Email
        </button>
    </form>

    {{-- Delete Account --}}
    <form action="{{ route('account.delete') }}" method="POST" class="mt-10">
        @csrf
        <button type="submit" onclick="return confirm('Are you sure you want to delete your account? This cannot be undone.')"
                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
            Delete Account
        </button>
    </form>
</div>
@endsection
