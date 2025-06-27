@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 px-4">
    <!-- Progress Steps -->
    <div class="flex justify-between mb-12 max-w-2xl mx-auto">
        <div class="text-center">
            <div class="w-10 h-10 mx-auto bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold mb-2">1</div>
            <h3 class="font-medium">SHOPPING BAG</h3>
            <p class="text-sm text-gray-500">Manage Your Items List</p>
        </div>
        <div class="text-center">
            <div class="w-10 h-10 mx-auto bg-gray-200 rounded-full flex items-center justify-center text-gray-600 font-bold mb-2">2</div>
            <h3 class="font-medium">SHIPPING AND CHECKOUT</h3>
            <p class="text-sm text-gray-500">Checkout Your Items List</p>
        </div>
        <div class="text-center">
            <div class="w-10 h-10 mx-auto bg-gray-200 rounded-full flex items-center justify-center text-gray-600 font-bold mb-2">3</div>
            <h3 class="font-medium">CONFIRMATION</h3>
            <p class="text-sm text-gray-500">Review And Submit Your Order</p>
        </div>
    </div>

    <!-- Cart Items -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-bold mb-6">YOUR CART ITEMS</h2>
        
        @if(count($products) > 0)
            @foreach($products as $product)
            <div class="flex flex-col md:flex-row border-b border-gray-200 py-4">
                <div class="flex items-start flex-1 mb-4 md:mb-0">
                    <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" class="w-20 h-20 object-cover rounded mr-4">
                    <div>
                        <h3 class="font-bold">{{ $product['name'] }}</h3>
                        <p class="text-gray-600 text-sm">{{ $product['variant_details'] ?? $product['variant_name'] }}</p>
                    </div>
                </div>
                <div class="flex items-center justify-between md:w-1/3">
                    <span class="font-bold">Rp{{ number_format($product['price'], 0, ',', '.') }}</span>
                    <div class="flex items-center">
                        <form action="{{ route('cart.update', ['productId' => $product['product_id'], 'variantId' => $product['variant_id']]) }}" method="POST">
                            @csrf
                            <button type="submit" name="quantity" value="{{ $product['quantity'] - 1 }}" class="px-3 py-1 border border-gray-300 rounded-l hover:bg-gray-100">-</button>
                            <span class="w-12 text-center border-t border-b border-gray-300 py-1">{{ $product['quantity'] }}</span>
                            <button type="submit" name="quantity" value="{{ $product['quantity'] + 1 }}" class="px-3 py-1 border border-gray-300 rounded-r hover:bg-gray-100">+</button>
                        </form>
                    </div>
                    <span class="font-bold">Rp{{ number_format($product['price'] * $product['quantity'], 0, ',', '.') }}</span>
                    <a href="{{ route('cart.remove', ['productId' => $product['product_id'], 'variantId' => $product['variant_id']]) }}" class="ml-4 text-red-500 hover:text-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        @else
            <p class="py-4">Keranjang anda kosong.</p>
        @endif
    </div>

    <!-- Cart Totals -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-6">CART TOTALS</h2>
        
        <div class="space-y-4">
            <div class="flex justify-between">
                <span>SUBTOTAL</span>
                <span class="font-bold">Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>
            
            <div class="flex justify-between border-t border-gray-200 pt-4">
                <span>PPN (10%)</span>
                <span class="font-bold">Rp{{ number_format($vat, 0, ',', '.') }}</span>
            </div>
            
            <div class="flex justify-between border-t border-gray-200 pt-4 font-bold text-lg">
                <span>TOTAL</span>
                <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
            </div>
        </div>
        
        @if(count($products) > 0)
        <a href="{{ route('checkout') }}" class="block w-full bg-indigo-600 text-white py-3 rounded-lg font-bold mt-6 hover:bg-indigo-700 transition text-center">
            PROCEED TO CHECKOUT
        </a>
        @endif
    </div>
</div>
@endsection