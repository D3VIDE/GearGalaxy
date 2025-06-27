@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 p-6">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Sidebar -->
        <div class="col-span-1 bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center text-xl text-white bg-blue-500">
                    {{ strtoupper(substr($user->user_name, 0, 1)) }}
                </div>
                <div>
                    <p class="font-semibold">{{ $user->user_name }}</p>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                </div>
            </div>

            <ul class="mt-6 space-y-2 text-sm text-gray-700">
                <li class="font-semibold text-blue-600">Akun</li>
                <!-- <li><a href="#" class="hover:text-blue-600">Pesanan</a></li>
                <li><a href="#" class="hover:text-blue-600">Wishlist</a></li>
                <li><a href="#" class="hover:text-blue-600">Alamat</a></li> -->
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-span-3 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Pengaturan Akun</h2>

            {{-- Alert --}}
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Errors --}}
            @if($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Username --}}
            <form action="{{ route('account.update.username') }}" method="POST" class="mb-6">
                @csrf
                <label class="block font-medium text-gray-700 mb-1">Username Saat Ini</label>
                <input type="text" class="w-full mb-3 px-4 py-2 bg-gray-100 border border-gray-300 rounded" value="{{ $user->user_name }}" disabled>

                <label for="username" class="block font-medium text-gray-700 mb-1">Ubah Username</label>
                <input type="text" name="username" id="username" value="{{ old('username') }}"
                       class="w-full mb-3 px-4 py-2 border border-gray-300 rounded focus:ring focus:ring-blue-300">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Simpan Username
                </button>
            </form>

            {{-- Email --}}
            <form action="{{ route('account.update.email') }}" method="POST" class="mb-6">
                @csrf
                <label class="block font-medium text-gray-700 mb-1">Email Saat Ini</label>
                <input type="text" class="w-full mb-3 px-4 py-2 bg-gray-100 border border-gray-300 rounded" value="{{ $user->email }}" disabled>

                <label for="email" class="block font-medium text-gray-700 mb-1">Ubah Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                       class="w-full mb-3 px-4 py-2 border border-gray-300 rounded focus:ring focus:ring-blue-300">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Simpan Email
                </button>
            </form>

            {{-- Delete Account --}}
            <form action="{{ route('account.delete') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                    Hapus Akun
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
