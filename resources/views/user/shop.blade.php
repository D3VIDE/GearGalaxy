@extends('layouts.app')

@section('content')
{{-- <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 p-4">
    @foreach ($products as $product)
      <x-product-card
        :image="$product->image"
        :variant="$product->variant"
        :colors="$product->colors"
        :name="$product->name"
        :price="$product->price"
      />
    @endforeach
  </div> --}}

<div class="py-16 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8 max-w-7xl mx-auto px-4">
    @php
      $products = [
        [
          'image' => 'https://images.unsplash.com/photo-1592921870789-04563d55041c?auto=format&fit=crop&w=774&q=80',
          'variant' => 'Space Grey',
          'colors' => ['#595759', '#d2d3d4', '#d89f97', '#afbfab', '#91a5bb'],
          'name' => 'Small Headphones',
          'price' => 299,
        ],
        [
          'image' => 'https://images.unsplash.com/photo-1592921870789-04563d55041c?auto=format&fit=crop&w=774&q=80',
          'variant' => 'Space Grey',
          'colors' => ['#595759', '#d2d3d4', '#d89f97', '#afbfab', '#91a5bb'],
          'name' => 'Small Headphones',
          'price' => 299,
        ],
        [
          'image' => 'https://images.unsplash.com/photo-1592921870789-04563d55041c?auto=format&fit=crop&w=774&q=80',
          'variant' => 'Space Grey',
          'colors' => ['#595759', '#d2d3d4', '#d89f97', '#afbfab', '#91a5bb'],
          'name' => 'Small Headphones',
          'price' => 299,
        ],
        [
          'image' => 'https://images.unsplash.com/photo-1592921870789-04563d55041c?auto=format&fit=crop&w=774&q=80',
          'variant' => 'Space Grey',
          'colors' => ['#595759', '#d2d3d4', '#d89f97', '#afbfab', '#91a5bb'],
          'name' => 'Small Headphones',
          'price' => 299,
        ],
        [
          'image' => 'https://images.unsplash.com/photo-1592921870789-04563d55041c?auto=format&fit=crop&w=774&q=80',
          'variant' => 'Space Grey',
          'colors' => ['#595759', '#d2d3d4', '#d89f97', '#afbfab', '#91a5bb'],
          'name' => 'Small Headphones',
          'price' => 299,
        ],
        [
          'image' => 'https://images.unsplash.com/photo-1592921870789-04563d55041c?auto=format&fit=crop&w=774&q=80',
          'variant' => 'Space Grey',
          'colors' => ['#595759', '#d2d3d4', '#d89f97', '#afbfab', '#91a5bb'],
          'name' => 'Small Headphones',
          'price' => 299,
        ],
      ];
    @endphp

    @foreach ($products as $index => $product)
      <x-product-card
        :image="$product['image']"
        :variant="$product['variant']"
        :colors="$product['colors']"
        :name="$product['name']"
        :price="$product['price']"
      />
    @endforeach
  </div>


@endsection