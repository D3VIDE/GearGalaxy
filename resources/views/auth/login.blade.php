@extends('layouts.auth')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-md">
        <!-- Header -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900">LOGIN</h2>
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
        <form class="space-y-6" method="POST" action="{{ route('login.post') }}">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address *</label>
                <input id="email" name="email" type="email" required 
                       value="{{ old('email') }}"
                       class="w-full px-3 py-2 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="your@email.com">
                @if($errors->has('email'))
                    <p class="mt-1 text-sm text-red-600">{{ $errors->first('email') }}</p>
                @endif
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password *</label>
                <input id="password" name="password" type="password" required
                       class="w-full px-3 py-2 border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }} rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="••••••••">
                @if($errors->has('password'))
                    <p class="mt-1 text-sm text-red-600">{{ $errors->first('password') }}</p>
                @endif
            </div>

            <!-- Login Button -->
            <div>
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    LOGIN
                </button>
            </div>
        </form>

        <!-- Footer Links -->
        <div class="mt-6 text-center text-sm">
            <span class="text-gray-600">No account yet?</span>
            <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 ml-1">
                Create Account
            </a>
            <span class="mx-2 text-gray-400">|</span>
            <a href="{{ route('forgot.password') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                Forgot Password
            </a>
        </div>
    </div>
</div>
@endsection