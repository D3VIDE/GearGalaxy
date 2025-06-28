@extends('layouts.app')

@section('content')
<div class="pt-8">
    {{-- Slider --}}
    <div class="container mx-auto px-4 mb-6">
        <div class="relative overflow-hidden rounded-lg shadow">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="https://images.tokopedia.net/img/cache/1208/NsjrJu/2025/6/19/1ecf71b2-8a3e-4dbf-a72c-dab9ab82dc3a.png"
                            class="w-full h-[370px] object-cover rounded-lg" alt="Promo 1">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.tokopedia.net/img/cache/1208/NsjrJu/2025/6/20/ec81cf36-307e-4ba4-b183-3620d458ea22.jpg"
                            class="w-full h-[370px] object-cover rounded-lg" alt="Promo 2">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.tokopedia.net/img/cache/1208/NsjrJu/2025/6/26/ad40a8b7-a8ca-4ac6-91fb-ef54a3b2e1c1.png"
                            class="w-full h-[370px] object-cover rounded-lg" alt="Promo 3">
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Produk Populer --}}
    <div class="container mx-auto px-4 my-12">
        <h3 class="text-xl font-semibold mb-4 text-red-600">🔥 Produk Populer</h3>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @foreach($popularProducts as $product)
                @if($product->variants->isNotEmpty())
                    @php $variant = $product->variants->first(); @endphp
                    <div class="bg-white border-2 border-red-300 rounded-lg shadow hover:shadow-md relative">
                        <a href="{{ route('product.detail', $variant->id) }}" class="group block bg-white border rounded-lg shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
                            <!-- Gambar Produk -->
                            <img
                                src="{{ $variant->image ? asset('storage/' . $variant->image) : 'https://via.placeholder.com/300x250' }}"
                                alt="{{ $product->product_name }}"
                                class="h-[200px] w-full object-cover sm:h-[250px]"
                            />

                            <!-- Info Produk -->
                            <div class="p-3">
                                <p class="text-xs text-gray-500">
                                    {{ ucfirst($product->category->category_name) ?? 'Kategori' }}
                                </p>

                                <div class="mt-2 flex justify-between text-sm">
                                    <h3 class="text-gray-900 font-semibold leading-tight line-clamp-2">
                                        {{ $product->product_name }}
                                    </h3>
                                    <p class="text-red-500 font-bold">
                                        Rp{{ number_format($variant->price ?? 0, 0, ',', '.') }}
                                    </p>
                                </div>

                                <div class="text-xs text-gray-500 mt-1">
                                     {{ $product->total_sold }} terjual
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    {{-- Produk Terbaru --}}
    <div class="container mx-auto px-4">
        <h3 class="text-xl font-semibold mb-4 text-gray-800">Produk Terbaru</h3>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @foreach($products as $product)
                @if($product->variants->isNotEmpty())
                    @php $variant = $product->variants->first(); @endphp
                    <a href="{{ route('product.detail', $variant->id) }}" class="group block bg-white border rounded-lg shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
                        <!-- Gambar Produk -->
                        <img
                            src="{{ $variant->image ? asset('storage/' . $variant->image) : 'https://via.placeholder.com/300x250' }}"
                            alt="{{ $product->product_name }}"
                            class="h-[200px] w-full object-cover sm:h-[250px]"
                        />

                        <!-- Info Produk -->
                        <div class="p-3">
                            <p class="text-xs text-gray-500">
                                {{ ucfirst($product->category->category_name) ?? 'Kategori' }}
                            </p>

                            <div class="mt-2 flex justify-between text-sm">
                                <h3 class="text-gray-900 font-semibold leading-tight line-clamp-2">
                                    {{ $product->product_name }}
                                </h3>
                                <p class="text-indigo-600 font-bold">
                                    Rp{{ number_format($variant->price ?? 0, 0, ',', '.') }}
                                </p>
                            </div>

                            <div class="text-xs text-gray-500 mt-1">
                                  {{ $product->total_sold }} terjual
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
    </div>

    {{-- Footer --}}
    <footer class="bg-gray-800 text-white mt-12">
        {{-- Keunggulan --}}
        <div class="container mx-auto px-4 pb-6 pt-8 border-t border-gray-700">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center text-gray-300">
                <div>
                    <i class="fas fa-shipping-fast text-indigo-400 text-2xl mb-1"></i>
                    <h4 class="text-sm font-bold">Gratis Ongkir</h4>
                    <p class="text-xs">Seluruh Indonesia</p>
                </div>
                <div>
                    <i class="fas fa-shield-alt text-indigo-400 text-2xl mb-1"></i>
                    <h4 class="text-sm font-bold">Transaksi Aman</h4>
                    <p class="text-xs">Pembayaran dijamin</p>
                </div>
                <div>
                    <i class="fas fa-star text-indigo-400 text-2xl mb-1"></i>
                    <h4 class="text-sm font-bold">Produk Terbaik</h4>
                    <p class="text-xs">Rating tinggi</p>
                </div>
                <div>
                    <i class="fas fa-headset text-indigo-400 text-2xl mb-1"></i>
                    <h4 class="text-sm font-bold">Support 24/7</h4>
                    <p class="text-xs">Siap membantu</p>
                </div>
            </div>
        </div>
        <div class="bg-gray-900 text-center py-3 text-xs text-gray-400">
            &copy; {{ date('Y') }} GearGalaxy. All rights reserved.
        </div>
    </footer>
</div>

{{-- SwiperJS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.mySwiper', {
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            loop: true
        });
    });
</script>
@endsection