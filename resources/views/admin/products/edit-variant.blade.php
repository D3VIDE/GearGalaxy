@extends('admin.AdminUi')

@section('content')
<div class="flex-1 ml-64 p-6 min-h-screen content-center">
    <div class="p-6 bg-white rounded-lg shadow">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Variant</h1>
        
        <form id="edit-variant-form" action="{{ route('updateVariant', $variant->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Variant Name</label>
                <input type="text" name="variant_name" value="{{ old('variant_name', $variant->variant_name) }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @error('variant_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" name="price" value="{{ old('price', $variant->price) }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @error('price')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', $variant->stock) }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @error('stock')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Current Image</label>
                @if($variant->image)
                    <img src="{{ asset('storage/'.$variant->image) }}" class="h-20 w-20 object-cover rounded mb-2">
                @else
                    <span class="text-sm text-gray-500">No image</span>
                @endif
                <input type="file" name="image"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex justify-end space-x-3">
                <a href="{{ route('ListVariant') }}"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                    Cancel
                </a>
                <button type="button"
                    onclick="confirmVariantUpdate()"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Update Variant
                </button>
            </div>
        </form>
    </div>
</div>


@push('scripts')  
<script>
function confirmVariantUpdate() {
    Swal.fire({
        title: 'Konfirmasi Update',
        text: "Apakah Anda yakin ingin menyimpan perubahan?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Simpan!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('edit-variant-form').submit();
        }
    });
}
</script>

@endpush
@endsection