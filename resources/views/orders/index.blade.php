@extends('layouts.app')

@section('title', 'Order')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Riwayat Transaksi</h1>

    @if ($orders->isEmpty())
        <div class="text-center text-gray-500 mt-20">
            <p class="text-lg">Belum ada transaksi.</p>
        </div>
    @else
        @foreach ($orders as $order)
        <div class="bg-white rounded-2xl shadow-md p-5 mb-6 border">
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M3 3h18v2H3zM6 6h12v2H6zM3 9h18v2H3zM6 12h12v2H6zM3 15h18v2H3zM6 18h12v2H6z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="text-sm text-gray-500">Belanja - {{ $order->created_at->format('d M Y') }}</span>
                </div>
                <span class="bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">Selesai</span>
            </div>

            <div class="flex gap-4">
                <img src="https://via.placeholder.com/60" alt="Product" class="w-16 h-16 rounded border">
                <div class="flex-1">
                    <h2 class="text-base font-semibold text-gray-800 truncate">
                        Produk dari Order #{{ $order->order_code }}
                    </h2>
                    <p class="text-sm text-gray-500">1 barang</p>
                    <p class="mt-1 text-sm text-gray-600">Alamat: {{ $order->address }}</p>
                </div>
            </div>

            <div class="flex justify-between items-center mt-4 border-t pt-4">
                <div class="text-sm text-gray-600">
                    Total Belanja: 
                    <span class="text-lg font-bold text-gray-800">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
                <a href="#" class="bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-full">
                    Beli Lagi
                </a>
            </div>
        </div>
        @endforeach
    @endif
</div>
@endsection
