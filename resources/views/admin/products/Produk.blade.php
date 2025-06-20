@extends('admin.AdminUi')

@section('content')
    <div class="flex-1 ml-64 p-6 min-h-screen">
        <div class="p-6 bg-white rounded-lg shadow">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Add Product</h1>
            </div>

            <!-- Form Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column -->
                <div class="lg:col-span-2">
                    <!-- Product Name -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Product name <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter product name">
                        <p class="mt-1 text-sm text-red-500">Do not exceed 100 characters when entering the product name.
                        </p>
                    </div>

                    <!-- Category -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <select
                            class="w-1/4 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <option selected disabled>Choose category</option>
                        </select>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Description <span class="text-red-500">*</span>
                        </label>
                        <textarea rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter product description"></textarea>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="lg:col-span-1">
                    <!-- Image Upload -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Product image <span class="text-red-500">*</span>
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div class="mt-2 text-sm text-gray-600">
                                <p>Upload a file or drag and drop</p>
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 10MB</p>
                            </div>
                            <input type="file" class="hidden">
                        </div>

                    </div>
                </div>
            </div>
            <button
                class="px-4 py-2 bg-blue-600 justify-content-end align-content-end text-white rounded hover:bg-blue-700">
                Add Product
            </button>
        </div>
    </div>
@endsection
