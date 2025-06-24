@extends('admin.AdminUi')

@section('content')
<div class="flex-1 ml-64 p-6 min-h-screen content-center">
    <div class="p-6 bg-white rounded-lg shadow">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">ADD VARIANT</h1>
        </div>
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('addVariant.post') }}" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                    <!-- Product Selection -->
                    <div class="mb-6">
                        <label for="products_id" class="block text-sm font-medium text-gray-700 mb-1">
                            Product <span class="text-red-500">*</span>
                        </label>
                        <select id="products_id" name="products_id"
                            class="w-1/2 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            required>
                            <option value="" selected disabled>Choose product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Variant Name -->
                    <div class="mb-6">
                        <label for="variant_name" class="block text-sm font-medium text-gray-700 mb-1">
                            Variant Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="variant_name" name="variant_name"
                            class="w-1/2 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter variant name" required>
                    </div>

                    <!-- Price -->
                    <div class="mb-6">
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">
                            Price <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="price" name="price" step="0.01"
                            class="w-1/4 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            placeholder="0.00" required>
                    </div>

                    <!-- Stock -->
                    <div class="mb-6">
                        <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">
                            Stock <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="stock" name="stock"
                            class="w-1/4 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            placeholder="0" required>
                    </div>

                    <!-- Image -->
                    <div class="mb-6">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                            Variant Image
                        </label>
                        <input type="file" id="image" name="image"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            accept="image/jpeg,image/png,image/jpg">
                    </div>
                </div>
            </div>
            <!-- Submit Button -->
            <div class="flex justify-end mt-6">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Add Variant
                </button>
            </div>
        </form>
    </div>
</div>
@endsection