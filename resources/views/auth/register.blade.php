@extends('layouts.auth')
@section('content')
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-md">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900">REGISTER</h1>
            </div>

            <!-- Error Message -->
            @if($errors->any() || session('error'))
                <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 rounded">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-red-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-red-700">
                            {{ $errors->first() ?? session('error') }}
                        </span>
                    </div>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('register.post') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                    <input id="user_name" name="user_name" type="text" value="{{ old('user_name') }}" required autofocus
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Username">
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address *</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="your@email.com">
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password *</label>
                    <input id="password" name="password" type="password" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="••••••••">
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password *</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="••••••••">
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-200 my-4"></div>

                <!-- Register Button -->
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    REGISTER
                </button>
            </form>

            <!-- Back to Login -->
            <div class="mt-6 text-center text-sm">
                <a href="{{ route('login') }}" class="font-medium text-slate-500 hover:text-slate-400">
                    Back to Login Page
                </a>
            </div>

        </div>
    </div>
@endsection()