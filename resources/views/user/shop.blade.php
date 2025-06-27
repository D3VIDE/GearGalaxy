@extends('layouts.app')

@section('content')
    <div class="py-16 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8 max-w-7xl mx-auto px-4">
        @foreach ($products as $product)
            <div class="group relative bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden border border-gray-100">
                <!-- Product Image with Variant Navigation -->
                <div class="aspect-square overflow-hidden relative bg-gray-50">
                    <img src="{{ asset('storage/' . $product['image']) }}" alt="{{ $product['name'] }}"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                        id="variant-image-{{ $product['id'] }}">

                    <!-- Variant Navigation Arrows (if multiple variants) -->
                    @if (isset($product['has_multiple_variants']))
                        <div class="absolute inset-0 flex items-center justify-between px-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <button class="variant-nav bg-white/90 rounded-full p-2 shadow-md hover:bg-white transition-colors"
                                data-target="{{ $product['id'] }}" data-direction="prev">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <button class="variant-nav bg-white/90 rounded-full p-2 shadow-md hover:bg-white transition-colors"
                                data-target="{{ $product['id'] }}" data-direction="next">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    @endif

                    <!-- Stock Badge -->
                    @if ($product['stock'] !== null)
                        <div class="absolute top-2 right-2 bg-white/95 px-2 py-1 text-xs rounded-full shadow-sm border border-gray-200">
                            Stock: {{ $product['stock'] }}
                        </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div class="p-4">
                    <p class="text-xs uppercase tracking-wider text-gray-500 mb-1">{{ $product['category'] }}</p>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2" id="variant-name-{{ $product['id'] }}">
                        {{ $product['name'] }}
                    </h3>

                    <!-- Attributes -->
                    @if (!empty($product['attributes']))
                        <div class="mb-3 space-y-1">
                            @foreach ($product['attributes'] as $attr)
                                <div class="text-sm flex items-center" 
                                     data-attribute-name="{{ $attr['name'] }}"
                                     data-attribute-detail="{{ $attr['detail'] }}"
                                     @if (isset($product['has_multiple_variants'])) 
                                     onclick="switchToVariantWithAttribute('{{ $product['id'] }}', '{{ $attr['name'] }}', '{{ $attr['detail'] }}')"
                                     class="cursor-pointer hover:bg-gray-50 px-2 py-1 rounded transition-colors" 
                                     @endif>
                                    <span class="font-medium text-gray-700">{{ ucfirst($attr['name']) }}:</span>
                                    <span class="ml-1 {{ $attr['is_active'] ? 'font-bold text-blue-600' : 'text-gray-600' }}">
                                        {{ ucfirst($attr['detail']) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="flex items-center justify-between mt-3">
                        <span class="text-lg font-bold text-gray-900" id="variant-price-{{ $product['id'] }}">
                            ${{ number_format($product['price'], 2) }}
                        </span>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-full text-sm font-medium transition-colors">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('scripts')
    <script>
        // Fungsi untuk switch variant berdasarkan atribut
        function switchToVariantWithAttribute(productId, attributeName, attributeDetail) {
            const variantData = document.querySelector(`.variant-data[data-product-id="${productId}"]`);
            if (!variantData) return;

            const variants = Array.from(variantData.children);
            const targetVariant = variants.find(v => {
                const attrName = v.getAttribute(`data-${attributeName}`);
                const attrDetail = v.getAttribute(`data-${attributeName}-detail`);
                return attrName && attrDetail && attrDetail === attributeDetail;
            });

            if (targetVariant) {
                // Update display
                document.getElementById(`variant-image-${productId}`).src =
                    targetVariant.getAttribute('data-variant-image');
                document.getElementById(`variant-name-${productId}`).textContent =
                    targetVariant.getAttribute('data-variant-name');
                document.getElementById(`variant-price-${productId}`).textContent =
                    '$' + targetVariant.getAttribute('data-variant-price');

                // Update active state
                document.querySelectorAll(`[data-product-id="${productId}"] [data-attribute-name]`).forEach(el => {
                    const isActive = el.getAttribute('data-attribute-name') === attributeName && 
                                    el.getAttribute('data-attribute-detail') === attributeDetail;
                    
                    const textSpan = el.querySelector('span:last-child');
                    if (textSpan) {
                        textSpan.classList.toggle('font-bold', isActive);
                        textSpan.classList.toggle('text-blue-600', isActive);
                        textSpan.classList.toggle('text-gray-600', !isActive);
                    }
                });
            }
        }
    </script>
@endsection