@extends('admin.AdminUi')

@section('content')
<div class="flex-1 ml-64 p-6 min-h-screen content-center">
    <div class="p-6 bg-white rounded-lg shadow">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">ADD VARIANT ATTRIBUTE</h1>
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

        <form method="POST" action="{{ route('addVariantAttribute.post') }}">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column -->
                <div class="lg:col-span-2">
                    <!-- Variant Select -->
                    <div class="mb-4">
                        <label for="variant_id" class="block text-sm font-medium text-gray-700 mb-1">
                            Variant <span class="text-red-500">*</span>
                        </label>
                        <select name="variant_id" id="variant_id" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <option value="" selected disabled>Choose variant</option>
                            @foreach ($variants as $variant)
                                <option value="{{ $variant->id }}">
                                    {{ $variant->product->product_name }} - {{ $variant->variant_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Attribute Name -->
                    <div class="mb-4">
                        <label for="attribute_name" class="block text-sm font-medium text-gray-700 mb-1">
                            Attribute Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="attribute_name" id="attribute_name"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                            placeholder="Enter attribute name" maxlength="255" required>
                    </div>

                    <!-- Attribute Detail -->
                    <div class="mb-4">
                        <label for="attribute_detail" class="block text-sm font-medium text-gray-700 mb-1">
                            Attribute Detail <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="attribute_detail" id="attribute_detail"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                            placeholder="Enter attribute detail" maxlength="255" required>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Add Variant Attribute
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
