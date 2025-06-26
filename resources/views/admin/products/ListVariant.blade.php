@extends('admin.AdminUi')

@section('content')
<div class="flex-1 ml-64 p-6 min-h-screen content-center">
    <div class="p-6 bg-white rounded-lg shadow">
        <!-- Header & Filter -->
        <div class="flex justify-between items-center mb-6 flex-wrap gap-4">
            <h1 class="text-2xl font-bold text-gray-800">LIST VARIANT</h1>

            <div class="flex items-center space-x-4">
                <!-- Filter Form -->
                <form method="GET" action="{{ route('ListVariant') }}" class="flex items-center space-x-3">
                    <label for="product_id" class="text-sm font-medium text-gray-700">Product:</label>
                    <select name="product_id" id="product_id"
                        class="w-40 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="">All</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ ($selectedProductId == $product->id) ? 'selected' : '' }}>
                                {{ $product->product_name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="px-5 py-2 bg-blue-600 text-white rounded text-sm hover:bg-blue-700 font-semibold">
                        Filter
                    </button>
                </form>

                <!-- Add Variant Button -->
                <a href="{{ route('addVariant') }}"
                    class="px-5 py-2 bg-green-600 text-white rounded text-sm hover:bg-green-700 font-semibold">
                    Add New Variant
                </a>
            </div>
        </div>

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

        <!-- Variant Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-center">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Variant Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Stock
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Image
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($variants as $variant)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $variant->variant_name ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Rp {{ number_format($variant->price, 0, ',', '.') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $variant->stock }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($variant->image)
                            <img src="{{ asset('storage/'.$variant->image) }}" alt="Variant Image" class="h-10 w-10 rounded-full mx-auto">
                            @else
                            <span class="text-sm text-gray-500">No image</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('editVariant', $variant->id) }}" 
                                   class="text-green-600 hover:text-green-900 inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                    <span class="ml-1">Edit</span>
                                </a>
                                
                                <form id="delete-variant-form-{{ $variant->id }}" 
                                      action="{{ route('deleteVariant', $variant->id) }}" 
                                      method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                            onclick="confirmVariantDelete({{ $variant->id }})"
                                            class="text-red-600 hover:text-red-900 inline-flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-1">Delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500 text-sm">
                            Tidak ada varian untuk produk yang dipilih.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmVariantDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Variant will be deleted permanently!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-variant-form-' + id).submit();
        }
    });
}
</script>
@endpush