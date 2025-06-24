@extends('admin.AdminUi')

@section('content')
<div class="flex-1 ml-64 p-6 min-h-screen content-center">
    <div class="p-6 bg-white rounded-lg shadow">
        <!-- Header & Filter -->
        <div class="flex justify-between items-center mb-6 flex-wrap gap-4">
            <h1 class="text-2xl font-bold text-gray-800">LIST VARIANT ATTRIBUTE</h1>

            <div class="flex items-center space-x-4">
                <!-- Filter Form -->
                <form method="GET" action="{{ route('listVariantAttribute') }}" class="flex items-center space-x-3">
                    <label for="variant_id" class="text-sm font-medium text-gray-700">Variant:</label>
                    <select name="variant_id" id="variant_id"
                        class="w-52 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="">All</option>
                        @foreach($variants as $variant)
                            <option value="{{ $variant->id }}" {{ ($selectedVariantId == $variant->id) ? 'selected' : '' }}>
                                {{ $variant->product->product_name }} - {{ $variant->variant_name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="px-5 py-2 bg-blue-600 text-white rounded text-sm hover:bg-blue-700 font-semibold">
                        Filter
                    </button>
                </form>

                <!-- Add Attribute Button -->
                <a href="{{ route('addVariantAttribute') }}"
                    class="px-5 py-2 bg-green-600 text-white rounded text-sm hover:bg-green-700 font-semibold">
                    Add New Attribute
                </a>
            </div>
        </div>

        <!-- Flash Messages -->
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

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-center">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">#</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Attribute Name</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Attribute Detail</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($attributes as $attribute)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $attribute->attribute_name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $attribute->attribute_detail ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm font-medium">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <button class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500 text-sm">
                                Tidak ada attribute untuk variant yang dipilih.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
