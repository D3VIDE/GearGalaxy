@extends('admin.AdminUi')

@section('content')
<div class="flex-1 ml-64 p-6 min-h-screen content-center">
    <div class="p-6 bg-white rounded-lg shadow">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Variant Attribute</h1>
        
        <form id="edit-attribute-form" action="{{ route('updateVariantAttribute', $attribute->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Variant</label>
                <select name="variant_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                    @foreach($variants as $variant)
                        <option value="{{ $variant->id }}" {{ $attribute->variant_id == $variant->id ? 'selected' : '' }}>
                            {{ $variant->product->product_name }} - {{ $variant->variant_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Attribute Name</label>
                <input type="text" name="attribute_name" value="{{ old('attribute_name', $attribute->attribute_name) }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Attribute Detail</label>
                <input type="text" name="attribute_detail" value="{{ old('attribute_detail', $attribute->attribute_detail) }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
            </div>
            
            <div class="flex justify-end space-x-3">
                <a href="{{ route('listVariantAttribute') }}"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                    Cancel
                </a>
                <button type="button"
                    onclick="confirmCategoryUpdate()"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Update Attribute
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmAttributeUpdate() {
    Swal.fire({
        title: 'Confirm Update',
        text: "Are you sure you want to update this attribute?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, update it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('edit-attribute-form').submit();
        }
    });
}
</script>


@endpush
@endsection