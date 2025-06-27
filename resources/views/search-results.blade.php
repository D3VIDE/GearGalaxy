@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Hasil Pencarian untuk "{{ $query }}"</h1>
    
    @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                @php $variant = $product->variants->first(); @endphp
                <a href="{{ route('product.detail', $variant->id) }}" class="bg-white rounded-lg shadow hover:shadow-md overflow-hidden transition-transform duration-300 hover:scale-105">
                    <img src="{{ $variant->image ? asset('storage/'.$variant->image) : asset('images/default-product.png') }}" 
                         class="w-full h-48 object-cover" alt="{{ $product->product_name }}">
                    <div class="p-4">
                        <h3 class="font-semibold text-lg text-gray-800">{{ $product->product_name }}</h3>
                        <p class="text-gray-600 text-sm mt-1">{{ $variant->variant_name }}</p>
                        <div class="mt-3 flex justify-between items-center">
                            <p class="text-indigo-600 font-bold">Rp{{ number_format($variant->price, 0, ',', '.') }}</p>
                            <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">
                                {{ $variant->sold_count }} Terjual
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        
        <div class="mt-8">
            {{ $products->appends(['query' => $query])->links() }}
        </div>
    @else
        <div class="text-center py-12 bg-gray-50 rounded-lg">
            <div class="inline-block p-4 bg-white rounded-full shadow">
                <i class="fas fa-search fa-3x text-gray-300"></i>
            </div>
            <h3 class="mt-4 text-lg font-medium text-gray-900">Produk tidak ditemukan</h3>
            <p class="mt-1 text-gray-500">Tidak ada hasil untuk "{{ $query }}"</p>
            <div class="mt-6">
                <a href="{{ route('shop') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-store-alt mr-2"></i> Kunjungi Toko
                </a>
            </div>
        </div>
    @endif
</div>
@endsection