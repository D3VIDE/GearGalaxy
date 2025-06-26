@extends('admin.AdminUi')

@section('content')
<div class="flex-1 ml-64 p-6 min-h-screen content-center">
    <div class="p-6 bg-white rounded-lg shadow">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Product</h1>
        
        <form id="edit-product-form"action="{{ route('updateProduk', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="product_name" class="block text-sm font-medium text-gray-700">Product Name</label>
                <input type="text" name="product_name" id="product_name" value="{{ $product->product_name }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <div class="mb-4">
                <label for="product_description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="product_description" id="product_description" rows="3"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ $product->product_description }}</textarea>
            </div>
            
            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" id="category_id"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="flex justify-end">
                <button type="button"
                    onclick="confirmProductUpdate()"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Update Kategori
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function confirmProductUpdate() {
    Swal.fire({
        title: 'Konfirmasi Update',
        text: "Apakah Anda yakin ingin mengupdate produk ini?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Update!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('edit-product-form').submit();
        }
    });
}
</script>
@endpush
@endsection