@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Filter Section - Dropdown version -->
        <div class="mb-8 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <h1 class="text-2xl font-bold">Our Products</h1>

            <div class="relative w-full sm:w-64">
                <div x-data="{ open: false }" class="relative">
                    <!-- Dropdown toggle button -->
                    <button @click="open = !open"
                        class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium border border-gray-300 rounded-lg bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <span>
                            @if (request('category'))
                                {{ request('category') }}
                            @else
                                Pilih Kategori
                            @endif
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div x-show="open" @click.away="open = false" x-transition
                        class="absolute right-0 z-10 w-full mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                        <div class="py-1">
                            <a href="{{ route('shop') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ !request('category') ? 'bg-blue-50 text-blue-600' : '' }}">
                                Semua Kategori
                            </a>
                            @foreach (\App\Models\Category::all() as $category)
                                <a href="{{ route('shop', ['category' => $category->category_name]) }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request('category') == $category->category_name ? 'bg-blue-50 text-blue-600' : '' }}">
                                    {{ $category->category_name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8">
            @foreach ($products as $product)
                <div
                    class="group relative bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden border border-gray-100">
                    <!-- Make the entire product image and info area clickable -->
                    <a href="{{ route('product.detail', ['variant' => $product['variant_id'] ?? $product['id']]) }}"
                        class="block">
                        <!-- Product Image with Variant Navigation -->
                        <div class="aspect-square overflow-hidden relative bg-gray-50">
                            <img src="{{ asset('storage/' . $product['image']) }}" alt="{{ $product['name'] }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                id="variant-image-{{ $product['id'] }}">

                            <!-- Variant Navigation Arrows (if multiple variants) -->
                            @if (isset($product['has_multiple_variants']))
                                <div class="absolute inset-0 flex items-center justify-between px-2">
                                    <button
                                        class="variant-nav bg-white/90 rounded-full p-2 shadow-md hover:bg-white transition-colors"
                                        data-target="{{ $product['id'] }}" data-direction="prev">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <button
                                        class="variant-nav bg-white/90 rounded-full p-2 shadow-md hover:bg-white transition-colors"
                                        data-target="{{ $product['id'] }}" data-direction="next">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            @endif

                            <!-- Stock Badge -->
                            @if ($product['stock'] !== null)
                                <div
                                    class="absolute top-2 right-2 bg-white/95 px-2 py-1 text-xs rounded-full shadow-sm border border-gray-200">
                                    Stock: {{ $product['stock'] }}
                                </div>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="p-4">
                            <p class="text-xs uppercase tracking-wider text-gray-500 mb-1">{{ $product['category'] }}</p>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2" id="variant-name-{{ $product['id'] }}">
                                {{ $product['name'] }}
                                @if (isset($product['variant_name']) && $product['variant_name'])
                                    <span class="text-lg font-semibold">- {{ $product['variant_name'] }}</span>
                                @endif
                            </h3>

                            <!-- Attributes - Only show one attribute per variant -->
                            <div class="mb-3 space-y-1 min-h-[40px]" id="variant-attribute-{{ $product['id'] }}">
                                @if (!empty($product['attributes']) && count($product['attributes']) > 0)
                                    @php
                                        // Only take the first attribute
                                        $attr = $product['attributes'][0];
                                    @endphp
                                    <div class="text-sm" data-attribute-name="{{ $attr['name'] }}"
                                        data-attribute-detail="{{ $attr['detail'] }}"
                                        @if (isset($product['has_multiple_variants'])) onclick="switchToVariantWithAttribute('{{ $product['id'] }}', '{{ $attr['name'] }}', '{{ $attr['detail'] }}')"
                                         class="cursor-pointer hover:bg-gray-50 px-2 py-1 rounded transition-colors" @endif>
                                        <span class="font-medium text-gray-700">{{ ucfirst($attr['name']) }}:</span>
                                        <span class="ml-1 text-gray-600" id="variant-attribute-value-{{ $product['id'] }}">
                                            {{ ucfirst($attr['detail']) }}
                                        </span>
                                    </div>
                                @else
                                    <!-- Empty space to maintain consistent height -->
                                    <div class="text-sm text-transparent">-</div>
                                @endif
                            </div>

                            <div class="flex items-center justify-between mt-3">
                                <span class="text-lg font-bold text-gray-900" id="variant-price-{{ $product['id'] }}">
                                    Rp{{ number_format($product['price'], 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </a>

                    <!-- Hidden variant data -->
                    @if (isset($product['has_multiple_variants']))
                        <div class="hidden variant-data" data-product-id="{{ $product['id'] }}">
                            @foreach ($product['all_variants'] as $variant)
                                <div data-variant-id="{{ $variant['id'] }}"
                                    data-variant-name="{{ $product['name'] . ($variant['variant_name'] ? ' - ' . $variant['variant_name'] : '') }}"
                                    data-variant-image="{{ asset('storage/' . $variant['image']) }}"
                                    data-variant-price="{{ number_format($variant['price'], 2) }}"
                                    data-variant-stock="{{ $variant['stock'] }}"
                                    @if (!empty($variant['attributes']) && count($variant['attributes']) > 0) @php
                                            $variantAttr = $variant['attributes'][0];
                                        @endphp
                                        data-attribute-name="{{ $variantAttr['name'] }}"
                                        data-attribute-detail="{{ $variantAttr['detail'] }}" @endif>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <!-- AlpineJS for dropdown functionality -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Track current variant index for each product
            const currentVariantIndices = {};

            // Initialize current variant indices
            document.querySelectorAll('.variant-data').forEach(variantData => {
                const productId = variantData.getAttribute('data-product-id');
                currentVariantIndices[productId] = 0;
            });

            // Handle variant navigation arrows
            document.querySelectorAll('.variant-nav').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const productId = this.getAttribute('data-target');
                    const direction = this.getAttribute('data-direction');
                    const productCard = this.closest('.group');
                    const variantData = productCard.querySelector('.variant-data');

                    if (variantData) {
                        const variants = Array.from(variantData.children);
                        let currentIndex = currentVariantIndices[productId] || 0;

                        // Determine new index
                        let newIndex;
                        if (direction === 'prev') {
                            newIndex = (currentIndex - 1 + variants.length) % variants.length;
                        } else {
                            newIndex = (currentIndex + 1) % variants.length;
                        }

                        const newVariant = variants[newIndex];
                        currentVariantIndices[productId] = newIndex;

                        // Update display
                        updateVariantDisplay(productCard, productId, newVariant);
                    }
                });
            });

            // Function to update variant display
            function updateVariantDisplay(productCard, productId, variant) {
                // Update main elements
                productCard.querySelector(`#variant-image-${productId}`).src =
                    variant.getAttribute('data-variant-image');
                productCard.querySelector(`#variant-name-${productId}`).textContent =
                    variant.getAttribute('data-variant-name');
                productCard.querySelector(`#variant-price-${productId}`).textContent =
                    'Rp' + variant.getAttribute('data-variant-price').replace('.00', '').replace(
                        /\B(?=(\d{3})+(?!\d))/g, '.');

                // Update stock display if exists
                const stockElement = productCard.querySelector('.absolute.top-2.right-2');
                if (stockElement) {
                    stockElement.textContent = 'Stock: ' + variant.getAttribute('data-variant-stock');
                }

                // Update the product link with the new variant ID
                const productLink = productCard.querySelector('a');
                if (productLink) {
                    const currentHref = new URL(productLink.href);
                    const newVariantId = variant.getAttribute('data-variant-id');
                    currentHref.pathname = currentHref.pathname.replace(/\/\d+$/, '/' + newVariantId);
                    productLink.href = currentHref.toString();
                }

                // Update attribute display
                updateVariantAttribute(productId, variant);
            }

            // Function to update variant attribute
            // Function to update variant attribute
            // Function to update variant attribute
function updateVariantAttribute(productId, variant) {
    const attributeName = variant.getAttribute('data-attribute-name');
    const attributeDetail = variant.getAttribute('data-attribute-detail');
    const attributeContainer = document.querySelector(`#variant-attribute-${productId}`);
    const attributeElement = attributeContainer.querySelector('[data-attribute-name]');
    const attributeValueElement = document.querySelector(`#variant-attribute-value-${productId}`);
    const placeholderElement = document.querySelector(`#variant-attribute-placeholder-${productId}`);

    if (attributeName && attributeDetail) {
        // Show the actual attribute element and hide placeholder
        if (attributeElement) {
            attributeElement.style.display = 'block';
            attributeElement.setAttribute('data-attribute-name', attributeName);
            attributeElement.setAttribute('data-attribute-detail', attributeDetail);
            attributeElement.querySelector('span.font-medium').textContent = `${attributeName}:`;
            if (attributeValueElement) {
                attributeValueElement.textContent = attributeDetail;
            }
        } else {
            // Create attribute element if it doesn't exist
            const newAttributeElement = document.createElement('div');
            newAttributeElement.className = 'text-sm cursor-pointer hover:bg-gray-50 px-2 py-1 rounded transition-colors';
            newAttributeElement.setAttribute('data-attribute-name', attributeName);
            newAttributeElement.setAttribute('data-attribute-detail', attributeDetail);
            newAttributeElement.innerHTML = `
                <span class="font-medium text-gray-700">${attributeName}:</span>
                <span class="ml-1 text-gray-600" id="variant-attribute-value-${productId}">${attributeDetail}</span>
            `;
            newAttributeElement.onclick = function() {
                switchToVariantWithAttribute(productId, attributeName, attributeDetail);
            };
            
            // Replace placeholder with new attribute element
            if (placeholderElement) {
                placeholderElement.replaceWith(newAttributeElement);
            } else {
                attributeContainer.appendChild(newAttributeElement);
            }
        }
        
        // Hide placeholder if exists
        if (placeholderElement) {
            placeholderElement.style.display = 'none';
        }
    } else {
        // Show placeholder and hide attribute element
        if (placeholderElement) {
            placeholderElement.style.display = 'block';
        } else {
            // Create placeholder if it doesn't exist
            const newPlaceholder = document.createElement('div');
            newPlaceholder.className = 'text-sm text-transparent select-none';
            newPlaceholder.id = `variant-attribute-placeholder-${productId}`;
            newPlaceholder.innerHTML = `
                <span class="font-medium">-</span>
                <span class="ml-1">-</span>
            `;
            
            // Replace attribute element with placeholder
            if (attributeElement) {
                attributeElement.replaceWith(newPlaceholder);
            } else {
                attributeContainer.appendChild(newPlaceholder);
            }
        }
        
        // Hide attribute element if exists
        if (attributeElement) {
            attributeElement.style.display = 'none';
        }
    }
}

            // Attribute click handler
            function switchToVariantWithAttribute(productId, attributeName, attributeDetail) {
                const variantData = document.querySelector(`.variant-data[data-product-id="${productId}"]`);
                if (!variantData) return;

                const variants = Array.from(variantData.children);
                const targetVariant = variants.find(v => {
                    return v.getAttribute('data-attribute-detail') === attributeDetail;
                });

                if (targetVariant) {
                    const productCard = variantData.closest('.group');
                    const variantIndex = variants.indexOf(targetVariant);
                    currentVariantIndices[productId] = variantIndex;

                    updateVariantDisplay(productCard, productId, targetVariant);
                }
            }

            // Prevent the variant navigation buttons from triggering the product link
            document.querySelectorAll('.variant-nav').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                });
            });
        });
    </script>
@endsection
