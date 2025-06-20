@extends('layouts.auth')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-md">
        <!-- Header -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900">LOGIN</h2>
        </div>

        <!-- Form -->
        <form class="space-y-6" method="POST" action="{{ route('login.post') }}">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address *</label>
                <input id="email" name="email" type="email" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    placeholder="your@email.com">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password *</label>
                <input id="password" name="password" type="password" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    placeholder="••••••••">
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-200 my-4"></div>

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
        <!-- Back to Login -->
        <div class="mt-6 text-center text-sm">
            <a href="{{ route('HomePage') }}" class="font-medium text-slate-500 hover:text-slate-400">
                Back to Main Page
            </a>
        </div>
    </div>
</div>
@endsection