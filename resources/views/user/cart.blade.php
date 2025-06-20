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
        
        <!-- Product 1 -->
        <div class="flex flex-col md:flex-row border-b border-gray-200 py-4">
            <div class="flex-1 mb-4 md:mb-0">
                <h3 class="font-bold">Zessi Dresses</h3>
                <p class="text-gray-600">Color: Yellow | Size: L</p>
            </div>
            <div class="flex items-center justify-between md:w-1/3">
                <span class="font-bold">$99.00</span>
                <div class="flex items-center">
                    <button class="px-3 py-1 border border-gray-300 rounded-l">-</button>
                    <span class="w-12 text-center border-t border-b border-gray-300 py-1">3</span>
                    <button class="px-3 py-1 border border-gray-300 rounded-r">+</button>
                </div>
                <span class="font-bold">$297.00</span>
            </div>
        </div>

        <!-- Product 2 -->
        <div class="flex flex-col md:flex-row border-b border-gray-200 py-4">
            <div class="flex-1 mb-4 md:mb-0">
                <h3 class="font-bold">Kirby TShirt</h3>
                <p class="text-gray-600">Color: Yellow | Size: L</p>
            </div>
            <div class="flex items-center justify-between md:w-1/3">
                <span class="font-bold">$99.00</span>
                <div class="flex items-center">
                    <button class="px-3 py-1 border border-gray-300 rounded-l">-</button>
                    <span class="w-12 text-center border-t border-b border-gray-300 py-1">1</span>
                    <button class="px-3 py-1 border border-gray-300 rounded-r">+</button>
                </div>
                <span class="font-bold">$99.00</span>
            </div>
        </div>
    </div>

    <!-- Cart Totals -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-6">CART TOTALS</h2>
        
        <div class="space-y-4">
            <div class="flex justify-between">
                <span>SUBTOTAL</span>
                <span class="font-bold">$396.00</span>
            </div>
            
            <div class="flex justify-between border-t border-gray-200 pt-4">
                <span>VAT (10%)</span>
                <span class="font-bold">$39.60</span>
            </div>
            
            <div class="flex justify-between border-t border-gray-200 pt-4 font-bold text-lg">
                <span>TOTAL</span>
                <span>$435.60</span>
            </div>
        </div>
        
        <a href="{{ route('checkout') }}" class="block w-full bg-indigo-600 text-white py-3 rounded-lg font-bold mt-6 hover:bg-indigo-700 transition text-center">
            PROCEED TO CHECKOUT
        </a>
    </div>
</div>
@endsection