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

        @if (session('success'))
            @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    timer: 2000,
                    showConfirmButton: false
                });
            </script>
            @endpush
        @endif

        @if (session('error'))
            @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}'
                });
            </script>
            @endpush
        @endif

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-center">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">#</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Variant</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Attribute Name</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Attribute Detail</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($attributes as $attribute)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $attribute->variant->product->product_name }} - {{ $attribute->variant->variant_name }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $attribute->attribute_name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $attribute->attribute_detail ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm font-medium">
                                <!-- Edit Button -->
                                <a href="{{ route('editVariantAttribute', $attribute->id) }}" 
                                   class="text-green-600 hover:text-green-900 mr-3 inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                    <span class="ml-1">Edit</span>
                                </a>
                                
                                <!-- Delete Button -->
                                <form id="delete-attribute-form-{{ $attribute->id }}" 
                                      action="{{ route('deleteVariantAttribute', $attribute->id) }}" 
                                      method="POST" 
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                            onclick="confirmAttributeDelete({{ $attribute->id }})"
                                            class="text-red-600 hover:text-red-900 inline-flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-1">Delete</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500 text-sm">
                                Tidak ada attribute untuk variant yang dipilih.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmAttributeDelete(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Attribute yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-attribute-form-' + id).submit();
        }
    });
}
</script>
@endpush
@endsection