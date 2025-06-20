@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 px-4">
    <div class="flex justify-between mb-12 max-w-2xl mx-auto">

    </div>

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
                        <input type="text" value="John Doe" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1">Phone Number *</label>
                        <input type="tel" value="08123456789" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="mb-8">
                <h3 class="font-medium mb-3 text-gray-700 border-b pb-2">Shipping Address</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 mb-1">Street Address *</label>
                        <input type="text" value="Jl. Sudirman No. 123" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1">Province *</label>
                        <select class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option>Select Province</option>
                            <option selected>DKI Jakarta</option>
                            <option>Jawa Barat</option>
                            <option>Jawa Tengah</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1">City *</label>
                        <select class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option>Select City</option>
                            <option selected>Jakarta Selatan</option>
                            <option>Jakarta Pusat</option>
                            <option>Jakarta Barat</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1">District *</label>
                        <input type="text" value="Setiabudi" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1">Postal Code *</label>
                        <input type="text" value="12920" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 mb-1">Notes</label>
                        <textarea class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" rows="2">Please deliver before 5pm</textarea>
                    </div>
                </div>
            </div>

            <!-- Shipping Method -->
            <div class="mb-8">
                <h3 class="font-bold mb-4 border-b pb-2">SHIPPING METHOD</h3>
                <div class="space-y-3" id="shippingMethods">
                    <label class="flex items-center border border-gray-200 rounded p-4 cursor-pointer shipping-option" data-method="jne">
                        <input type="radio" name="shipping-method" value="jne" class="mr-3" checked>
                        <div class="flex-1">
                            <p class="font-medium">JNE Regular</p>
                            <p class="text-sm text-gray-500">2-3 business days</p>
                        </div>
                        <span class="font-bold">$5.00</span>
                        <img src="jne-logo.png" alt="JNE" class="ml-3 h-8 opacity-100">
                    </label>
                    <label class="flex items-center border border-gray-200 rounded p-4 cursor-pointer shipping-option" data-method="jnt">
                        <input type="radio" name="shipping-method" value="jnt" class="mr-3">
                        <div class="flex-1">
                            <p class="font-medium">J&T Express</p>
                            <p class="text-sm text-gray-500">1-2 business days</p>
                        </div>
                        <span class="font-bold">$9.00</span>
                        <img src="jnt-logo.png" alt="J&T" class="ml-3 h-8 opacity-70">
                    </label>
                    <label class="flex items-center border border-gray-200 rounded p-4 cursor-pointer shipping-option" data-method="sicepat">
                        <input type="radio" name="shipping-method" value="sicepat" class="mr-3">
                        <div class="flex-1">
                            <p class="font-medium">SiCepat</p>
                            <p class="text-sm text-gray-500">3-5 business days</p>
                        </div>
                        <span class="font-bold">$4.00</span>
                        <img src="sicepat-logo.png" alt="SiCepat" class="ml-3 h-8 opacity-70">
                    </label>
                </div>
            </div>

            <!-- Payment Section -->
            <div id="paymentSection">
                <h3 class="font-bold mb-4 border-b pb-2">PAYMENT METHOD</h3>
                <!-- Bank Transfer -->
                <div class="mb-4 p-4 border rounded-lg cursor-pointer payment-method" onclick="selectPayment('bank')">
                    <div class="flex items-center">
                        <input type="radio" name="payment" id="bank" class="mr-3" checked>
                        <div>
                            <label for="bank" class="font-medium">Bank Transfer</label>
                            <p class="text-sm text-gray-500">BCA, Mandiri, BRI, BNI</p>
                        </div>
                    </div>
                    <div id="bank-details" class="mt-3 pl-8">
                        <div class="mb-3">
                            <label class="block text-gray-700 mb-1">Bank Name</label>
                            <select class="w-full p-2 border rounded">
                                <option>BCA</option>
                                <option>Mandiri</option>
                                <option>BRI</option>
                                <option>BNI</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-1">Account Number</label>
                            <input type="text" class="w-full p-2 border rounded" placeholder="1234567890">
                        </div>
                    </div>
                </div>

                <!-- E-Wallet -->
                <div class="mb-4 p-4 border rounded-lg cursor-pointer payment-method" onclick="selectPayment('ewallet')">
                    <div class="flex items-center">
                        <input type="radio" name="payment" id="ewallet" class="mr-3">
                        <div>
                            <label for="ewallet" class="font-medium">E-Wallet</label>
                            <p class="text-sm text-gray-500">DANA, GOPAY, OVO</p>
                        </div>
                    </div>
                    <div id="ewallet-details" class="mt-3 pl-8 hidden">
                        <div class="mb-3">
                            <label class="block text-gray-700 mb-1">E-Wallet</label>
                            <select class="w-full p-2 border rounded">
                                <option>DANA</option>
                                <option>GOPAY</option>
                                <option>OVO</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-1">Phone Number</label>
                            <input type="tel" class="w-full p-2 border rounded" placeholder="08123456789">
                        </div>
                    </div>
                </div>

                <!-- Credit Card -->
                <div class="mb-4 p-4 border rounded-lg cursor-pointer payment-method" onclick="selectPayment('card')">
                    <div class="flex items-center">
                        <input type="radio" name="payment" id="card" class="mr-3">
                        <div>
                            <label for="card" class="font-medium">Credit/Debit Card</label>
                            <p class="text-sm text-gray-500">Visa, Mastercard, JCB</p>
                        </div>
                    </div>
                    <div id="card-details" class="mt-3 pl-8 hidden">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <label class="block text-gray-700 mb-1">Card Number</label>
                                <input type="text" class="w-full p-2 border rounded" placeholder="1234 5678 9012 3456">
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-1">Expiry Date</label>
                                <input type="text" class="w-full p-2 border rounded" placeholder="MM/YY">
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-1">CVV</label>
                                <input type="text" class="w-full p-2 border rounded" placeholder="123">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- COD -->
                <div class="p-4 border rounded-lg cursor-pointer payment-method" onclick="selectPayment('cod')">
                    <div class="flex items-center">
                        <input type="radio" name="payment" id="cod" class="mr-3">
                        <div>
                            <label for="cod" class="font-medium">Cash on Delivery (COD)</label>
                            <p class="text-sm text-gray-500">Pay when you receive the items</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="lg:w-1/3 bg-white rounded-lg shadow-md p-6 h-fit sticky top-4">
            <h2 class="text-xl font-bold mb-6">ORDER SUMMARY</h2>
            <div class="space-y-4">
                <div class="flex justify-between">
                    <span class="text-gray-600">Subtotal</span>
                    <span class="font-medium">$120.00</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Shipping</span>
                    <span class="font-medium" id="shippingCost">$5.00</span>
                </div>
                <div class="flex justify-between border-t pt-4">
                    <span class="font-bold">Total</span>
                    <span class="font-bold text-lg" id="totalAmount">$125.00</span>
                </div>
            </div>
            <a href="{{ route('confirmation') }}" class="block w-full bg-indigo-600 text-white py-3 rounded-lg font-bold mt-6 hover:bg-indigo-700 transition-colors text-center">
                PLACE ORDER
            </a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Shipping method selection
    const shippingOptions = document.querySelectorAll('.shipping-option');
    const paymentSection = document.getElementById('paymentSection');
    const shippingCost = document.getElementById('shippingCost');
    const totalAmount = document.getElementById('totalAmount');
    const subtotal = 120.00; // Example subtotal

    shippingOptions.forEach(option => {
        option.addEventListener('click', function() {
            // Reset all options
            shippingOptions.forEach(opt => {
                opt.classList.remove('border-indigo-500', 'bg-indigo-50');
                opt.querySelector('img').classList.add('opacity-70');
                opt.querySelector('img').classList.remove('opacity-100');
            });

            // Activate selected option
            this.classList.add('border-indigo-500', 'bg-indigo-50');
            this.querySelector('img').classList.remove('opacity-70');
            this.querySelector('img').classList.add('opacity-100');

            // Update shipping cost
            const cost = this.querySelector('span').textContent;
            shippingCost.textContent = cost;
            
            // Update total
            const shippingValue = parseFloat(cost.replace('$', ''));
            totalAmount.textContent = '$' + (subtotal + shippingValue).toFixed(2);

            // Show payment section
            paymentSection.classList.remove('hidden');
        });
    });

    // Payment method selection
    window.selectPayment = function(type) {
        // Reset all payment methods
        document.querySelectorAll('.payment-method').forEach(el => {
            el.classList.remove('border-indigo-500', 'bg-indigo-50');
        });
        document.querySelectorAll('[id$="-details"]').forEach(el => {
            el.classList.add('hidden');
        });
        
        // Activate selected
        const selected = document.querySelector(`#${type}`);
        selected.checked = true;
        selected.closest('.payment-method').classList.add('border-indigo-500', 'bg-indigo-50');
        
        // Show details if needed
        if (type !== 'cod') {
            document.querySelector(`#${type}-details`).classList.remove('hidden');
        }
    };
});
</script>
@endsection