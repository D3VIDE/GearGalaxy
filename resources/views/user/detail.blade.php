@extends('layouts.app')

@section('content')
<div class="py-32">
    <div class="container mx-auto px-4">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            {{-- Gambar --}}
            <div class="lg:col-span-4">
                <div class="border rounded-lg overflow-hidden mb-4">
                    <img src="{{ asset('storage/' . $variant->image) }}" alt="{{ $variant->variant_name }}"
                        class="w-full h-[350px] object-cover">
                </div>

                {{-- Gambar Varian Lain --}}
                <div class="flex gap-3 overflow-x-auto mt-4">
                    @foreach($variant->product->variants as $v)
                        <a href="{{ route('product.detail', $v->id) }}"
                        class="rounded overflow-hidden border-2 {{ $v->id === $variant->id ? 'border-indigo-600' : 'border-gray-300 hover:border-indigo-400' }} transition">
                            <img src="{{ asset('storage/' . $v->image) }}"
                                alt="{{ $v->variant_name }}"
                                class="w-20 h-20 object-cover" />
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Informasi Produk --}}
            <div class="lg:col-span-4 space-y-4">
                <h1 class="text-2xl font-bold text-gray-800">{{ $variant->variant_name }}</h1>
                <p class="text-sm text-gray-500">Produk: {{ $variant->product->product_name }} | Kategori: {{ $variant->product->category->category_name }}</p>
                <div class="text-2xl font-bold text-indigo-600">
                    Rp{{ number_format($variant->price, 0, ',', '.') }}
                </div>
                <p class="text-gray-600 text-sm break-words max-w-full lg:max-w-md">
                    {{ $variant->product->product_description }}
                </p>

                {{-- Detail Atribut --}}
                @if($variant->attributes->count())
                    <div class="mt-4 space-y-1">
                        <h4 class="font-semibold text-sm text-gray-800">Detail:</h4>
                        @foreach($variant->attributes as $attr)
                            <p class="text-sm text-gray-600">
                                {{ $attr->attribute_name }}: {{ $attr->attribute_detail ?? '-' }}
                            </p>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Form Pembelian --}}
            <div class="lg:col-span-3">
                @if($variant->stock > 0)
                    <form action="{{ route('cart.add', $variant->product->id) }}" method="POST" class="space-y-3">
                        @csrf
                        <input type="hidden" name="variant_id" value="{{ $variant->id }}">
                        <div class="border rounded-lg p-4 shadow-sm">
                            <div class="space-y-4">
                                <label class="block font-bold text-gray-700">Atur jumlah pembelian</label>

                                <div class="flex items-center gap-2">
                                    <button type="button" onclick="changeQty(-1)"
                                        class="px-2 py-1 rounded border text-sm hover:bg-gray-100">−</button>

                                    <input type="number" id="qty" name="quantity"
                                        value="1" min="1" max="{{ $variant->stock }}"
                                        class="w-16 text-center border rounded text-sm py-1" onchange="updateSubtotal()" />

                                    <button type="button" onclick="changeQty(1)"
                                        class="px-2 py-1 rounded border text-sm hover:bg-gray-100">+</button>
                                    <span class="text-sm text-gray-600">
                                        Stok: <span class="font-bold">{{ $variant->stock }}</span>
                                    </span>
                                </div>

                                <div class="mt-2 flex justify-between items-center">
                                    <span class="font-medium">Subtotal</span>
                                    <span class="font-bold text-indigo-700 text-lg" id="subtotal">
                                        Rp{{ number_format($variant->price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <div class="mt-4 space-y-2">
                                <button type="submit"
                                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 text-sm rounded">
                                    + Keranjang
                                </button>
                            </div>
                        </div>
                    </form>
                @else
                    <div class="border rounded-lg p-4 shadow-sm">
                        <button type="button"
                            class="w-full bg-gray-300 text-gray-500 py-2 px-4 text-sm rounded cursor-not-allowed" disabled>
                            Stok Habis
                        </button>
                    </div>
                @endif
            </div>

        </div>

    </div>
</div>

{{-- Script for dynamic subtotal --}}
<script>
    // Gunakan harga langsung dari variant
    const price = {{ $variant->price }};
    const maxStock = {{ $variant->stock }};

    function changeQty(change) {
        const qtyInput = document.getElementById('qty');
        let qty = parseInt(qtyInput.value);

        qty += change;
        if (qty < 1) qty = 1;
        if (qty > maxStock) qty = maxStock;

        qtyInput.value = qty;
        updateSubtotal();
    }

    function updateSubtotal() {
        const qty = parseInt(document.getElementById('qty').value);
        const subtotal = price * qty;
        document.getElementById('subtotal').innerText = 'Rp' + subtotal.toLocaleString('id-ID');
    }
</script>

@if(session('error'))
<script>
    alert('{{ session('error') }}');
</script>
@endif
@endsection