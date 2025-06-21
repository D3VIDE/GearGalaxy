@extends('admin.AdminUi')

@section('content')
    <div class="flex-1 ml-64 p-6 min-h-screen content-center">


        <div class="p-6 bg-white rounded-lg shadow">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">ADD PRODUCT</h1>
            </div>
            <!-- Form -->
            <form method="POST" action="{{ route('addProduk.post') }}" enctype="multipart/form-data">
                @csrf

                <!-- Form Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Left Column -->
                    <div class="lg:col-span-2">
                        <!-- Product Name -->
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                Product name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="product_name" name="product_name"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter product name" maxlength="100" required>
                            <p class="mt-1 text-sm text-red-500">Do not exceed 100 characters when entering the product
                                name.</p>
                        </div>

                        <!-- Category -->
                        <div class="mb-6">
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">
                                Category <span class="text-red-500">*</span>
                            </label>
                            <select id="category_id" name="category_id"
                                class="w-1/4 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                required>
                                <option value="" selected disabled>Choose category</option>

                            </select>
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                Description <span class="text-red-500">*</span>
                            </label>
                            <textarea id="product_description" name="product_description" rows="4"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter product description" required></textarea>
                        </div>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="flex justify-end mt-6">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Add Product
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
