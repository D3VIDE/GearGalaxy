@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 px-4">
    <!-- Progress Steps -->
    <div class="flex justify-between mb-12 max-w-2xl mx-auto">
        <div class="text-center">
            <div class="w-10 h-10 mx-auto bg-gray-200 rounded-full flex items-center justify-center text-gray-600 font-bold mb-2">1</div>
            <h3 class="font-medium">SHOPPING BAG</h3>
            <p class="text-sm text-gray-500">Manage Your Items List</p>
        </div>
        <div class="text-center">
            <div class="w-10 h-10 mx-auto bg-gray-200 rounded-full flex items-center justify-center text-gray-600 font-bold mb-2">2</div>
            <h3 class="font-medium">SHIPPING AND CHECKOUT</h3>
            <p class="text-sm text-gray-500">Checkout Your Items List</p>
        </div>
        <div class="text-center">
            <div class="w-10 h-10 mx-auto bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold mb-2">3</div>
            <h3 class="font-medium">CONFIRMATION</h3>
            <p class="text-sm text-gray-500">Review And Submit Your Order</p>
        </div>
    </div>

    <!-- Confirmation Message -->
    <div class="bg-white rounded-lg shadow-md p-8 text-center max-w-2xl mx-auto mb-8">
        <div class="w-16 h-16 mx-auto bg-green-100 rounded-full flex items-center justify-center text-green-600 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <h2 class="text-2xl font-bold mb-2">ORDER #{{ $order->order_code }} RECEIVED</h2>
        <p class="text-lg mb-6">Thank you. Your order has been received.</p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="border border-gray-200 rounded p-4">
                <h3 class="font-medium text-gray-500 mb-1">Date</h3>
                <p class="font-bold">{{ $order->created_at->format('d/m/Y') }}</p>
            </div>
            <div class="border border-gray-200 rounded p-4">
                <h3 class="font-medium text-gray-500 mb-1">Total</h3>
                <p class="font-bold">${{ number_format($order->total_price, 2) }}</p>
            </div>
            <div class="border border-gray-200 rounded p-4">
                <h3 class="font-medium text-gray-500 mb-1">Payment Method</h3>
                <p class="font-bold">
                    @if($order->payment_method == 'BANK')
                        Bank Transfer
                    @elseif($order->payment_method == 'COD')
                        Cash on Delivery
                    @else
                        E-Wallet
                    @endif
                </p>
            </div>
        </div>
    </div>

    <!-- Order Details -->
    <div class="bg-white rounded-lg shadow-md p-6 max-w-2xl mx-auto">
        <h2 class="text-xl font-bold mb-6">ORDER DETAILS</h2>
        
        <div class="border-b border-gray-200 pb-4 mb-4">
            <h3 class="font-medium mb-2">PRODUCT</h3>
            @foreach($order->items as $item)
            <div class="flex justify-between mb-2">
                <span>{{ $item->product->name }} ({{ $item->variant->getVariantDetails() }}) × {{ $item->amount }}</span>
                <span>${{ number_format($item->subtotal, 2) }}</span>
            </div>
            @endforeach
        </div>
        
        <div class="border-b border-gray-200 pb-4 mb-4">
            <div class="flex justify-between mb-2">
                <span>SUBTOTAL</span>
                <span>${{ number_format($order->items->sum('subtotal'), 2) }}</span>
            </div>
            <div class="flex justify-between">
                <span>VAT (10%)</span>
                <span>${{ number_format($order->items->sum('subtotal') * 0.1, 2) }}</span>
            </div>
        </div>
        
        <div class="flex justify-between font-bold text-lg">
            <span>TOTAL</span>
            <span>${{ number_format($order->total_price, 2) }}</span>
        </div>
    </div>

    <!-- Shipping Information -->
    <div class="bg-white rounded-lg shadow-md p-6 max-w-2xl mx-auto mt-6">
        <h2 class="text-xl font-bold mb-4">SHIPPING INFORMATION</h2>
        <div class="whitespace-pre-line">{{ $order->address }}</div>
    </div>

    <!-- Order Notes -->
    @if($order->notes)
    <div class="bg-white rounded-lg shadow-md p-6 max-w-2xl mx-auto mt-6">
        <h2 class="text-xl font-bold mb-4">ORDER NOTES</h2>
        <p>{{ $order->notes }}</p>
    </div>
    @endif

    <!-- Continue Shopping Button -->
    <div class="text-center mt-8">
        <a href="{{ route('HomePage') }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-indigo-700 transition">
            CONTINUE SHOPPING
        </a>
    </div>
</div>
@endsection