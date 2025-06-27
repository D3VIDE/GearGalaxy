@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 px-4">
    <div class="flex justify-between mb-12 max-w-2xl mx-auto">
        <div class="text-center">
            <div class="w-10 h-10 mx-auto bg-gray-200 rounded-full flex items-center justify-center text-gray-600 font-bold mb-2">1</div>
            <h3 class="font-medium">SHOPPING BAG</h3>
            <p class="text-sm text-gray-500">Manage Your Items List</p>
        </div>
        <div class="text-center">
            <div class="w-10 h-10 mx-auto bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold mb-2">2</div>
            <h3 class="font-medium">SHIPPING AND CHECKOUT</h3>
            <p class="text-sm text-gray-500">Checkout Your Items List</p>
        </div>
        <div class="text-center">
            <div class="w-10 h-10 mx-auto bg-gray-200 rounded-full flex items-center justify-center text-gray-600 font-bold mb-2">3</div>
            <h3 class="font-medium">CONFIRMATION</h3>
            <p class="text-sm text-gray-500">Review And Submit Your Order</p>
        </div>
    </div>

    <form action="{{ route('checkout.post') }}" method="POST">
        @csrf
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Shipping Details -->
            <div class="lg:w-2/3 bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold mb-6">SHIPPING DETAILS</h2>
                
                <!-- Personal Information -->
                <div class="mb-8">
                    <h3 class="font-medium mb-3 text-gray-700 border-b pb-2">Personal Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 mb-1">Full Name *</label>
                            <input type="text" name="full_name" value="{{ Auth::user()->name }}" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-1">Phone Number *</label>
                            <input type="tel" name="phone_number" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        </div>
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="mb-8">
                    <h3 class="font-medium mb-3 text-gray-700 border-b pb-2">Shipping Address</h3>
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-gray-700 mb-1">Complete Address *</label>
                            <textarea name="complete_address" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" rows="4" required></textarea>
                            <p class="text-sm text-gray-500">Include recipient name, street, city, and postal code</p>
                        </div>
                    </div>
                </div>

                <!-- Payment Section -->
                <div id="paymentSection">
                    <h3 class="font-bold mb-4 border-b pb-2">PAYMENT METHOD</h3>
                    
                    <!-- Bank Transfer -->
                    <div class="mb-4 p-4 border rounded-lg cursor-pointer payment-method active" onclick="selectPayment('bank')">
                        <div class="flex items-center">
                            <input type="radio" name="payment_method" id="bank" value="BANK" class="mr-3" checked>
                            <div>
                                <label for="bank" class="font-medium">Bank Transfer</label>
                                <p class="text-sm text-gray-500">Transfer ke rekening BCA/Mandiri/BRI</p>
                            </div>
                        </div>
                    </div>

                    <!-- COD -->
                    <div class="mb-4 p-4 border rounded-lg cursor-pointer payment-method" onclick="selectPayment('cod')">
                        <div class="flex items-center">
                            <input type="radio" name="payment_method" id="cod" value="COD" class="mr-3">
                            <div>
                                <label for="cod" class="font-medium">Cash on Delivery (COD)</label>
                                <p class="text-sm text-gray-500">Bayar ketika barang diterima</p>
                            </div>
                        </div>
                    </div>

                    <!-- E-Wallet -->
                    <div class="p-4 border rounded-lg cursor-pointer payment-method" onclick="selectPayment('ewallet')">
                        <div class="flex items-center">
                            <input type="radio" name="payment_method" id="ewallet" value="EWALLET" class="mr-3">
                            <div>
                                <label for="ewallet" class="font-medium">E-Wallet</label>
                                <p class="text-sm text-gray-500">DANA/OVO/Gopay</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div class="mt-8">
                    <h3 class="font-medium mb-3 text-gray-700 border-b pb-2">Order Notes</h3>
                    <textarea name="notes" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" rows="3" placeholder="Special instructions for your order..."></textarea>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:w-1/3 bg-white rounded-lg shadow-md p-6 h-fit sticky top-4">
                <h2 class="text-xl font-bold mb-6">ORDER SUMMARY</h2>
                <div class="space-y-4">
                    @foreach($products as $item)
                    <div class="flex justify-between">
                        <span>{{ $item['product']->name }} ({{ $item['variant']->getVariantDetails() }}) × {{ $item['quantity'] }}</span>
                        <span class="font-medium">Rp {{ number_format($item['subtotal'], 2) }}</span>
                    </div>
                    @endforeach
                    
                    <div class="border-t pt-4">
                        <div class="flex justify-between mb-2">
                            <span>SUBTOTAL</span>
                            <span class="font-medium">Rp {{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>VAT (10%)</span>
                            <span class="font-medium">Rp {{ number_format($vat, 2) }}</span>
                        </div>
                    </div>
                    
                    <div class="flex justify-between border-t pt-4">
                        <span class="font-bold">TOTAL</span>
                        <span class="font-bold text-lg">Rp {{ number_format($total, 2) }}</span>
                    </div>
                </div>
                
                <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg font-bold mt-6 hover:bg-indigo-700 transition-colors">
                    PLACE ORDER
                </button>
            </div>
        </div>
    </form>
</div>

<script>
// Payment method selection
function selectPayment(type) {
    // Reset all payment methods
    document.querySelectorAll('.payment-method').forEach(el => {
        el.classList.remove('border-indigo-500', 'bg-indigo-50', 'active');
    });
    
    // Activate selected
    const selected = document.querySelector(`#${type}`);
    selected.checked = true;
    selected.closest('.payment-method').classList.add('border-indigo-500', 'bg-indigo-50', 'active');
}

// Initialize first payment method as active
document.addEventListener('DOMContentLoaded', function() {
    selectPayment('bank');
});
</script>

<style>
.payment-method.active {
    border-color: #6366f1;
    background-color: #eef2ff;
}
</style>
@endsection