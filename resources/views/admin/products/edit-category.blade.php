@extends('admin.AdminUi')

@section('content')
<div class="flex-1 ml-64 p-6 min-h-screen content-center">
    <div class="p-6 bg-white rounded-lg shadow">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Kategori</h1>
        
        <form id="edit-category-form" action="{{ route('updateCategory', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                <input type="text" name="category_name" value="{{ $category->category_name }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            
            <div class="flex justify-end space-x-3">
                <a href="{{ route('ListCategory') }}"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                    Batal
                </a>
                <button type="button"
                    onclick="confirmCategoryUpdate()"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Update Kategori
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function confirmCategoryUpdate() {
    Swal.fire({
        title: 'Konfirmasi Update',
        text: "Apakah Anda yakin ingin mengupdate kategori ini?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Update!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('edit-category-form').submit();
        }
    });
}
</script>
@endpush
@endsection