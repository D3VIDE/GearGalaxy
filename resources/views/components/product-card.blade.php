<a href="#" class="group block">
  <img
    src="{{ $image ?? 'https://via.placeholder.com/300x250' }}"
    alt=""
    class="h-[200px] w-full object-cover sm:h-[250px]"
  />

  <div class="mt-1">
    <p class="text-xs text-gray-500">{{ $variant ?? 'Variant' }}</p>

    <div class="mt-1 flex gap-1">
      <form>
        <div class="flex flex-wrap justify-center gap-1">
          @foreach ($colors ?? [] as $color)
            <div>
              <input type="checkbox" id="color_{{ $loop->parent->index }}_{{ $loop->index }}" class="sr-only" />
              <label
                for="color_{{ $loop->parent->index }}_{{ $loop->index }}"
                class="block size-3 sm:size-4 cursor-pointer rounded-full transition hover:!opacity-100"
                style="background-color: {{ $color }};"
              >
                <span class="sr-only">Color</span>
              </label>
            </div>
          @endforeach
        </div>
      </form>
    </div>

    <div class="mt-2 flex justify-between text-sm">
      <h3 class="text-gray-900 group-hover:underline group-hover:underline-offset-4">
        {{ $name ?? 'Product Name' }}
      </h3>
      <p class="text-gray-900">${{ $price ?? '0.00' }}</p>
    </div>
  </div>
</a>
