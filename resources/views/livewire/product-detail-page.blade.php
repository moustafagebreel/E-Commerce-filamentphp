<div>
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        @if (session()->has('cart_success'))
            <div class="p-4 mb-6 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                {{ session('cart_success') }}
            </div>
        @endif

        <section class="overflow-hidden bg-white py-11 font-poppins dark:bg-gray-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700">
          <div class="max-w-6xl px-4 py-4 mx-auto lg:py-8 md:px-6">
            <div class="flex flex-wrap -mx-4">
              <!-- Gallery Section -->
              <div class="w-full mb-8 md:w-1/2 md:mb-0" x-data="{ mainImage: '{{ is_array($product->images) && count($product->images) > 0 ? url('storage/' . $product->images[0]) : 'https://via.placeholder.com/600' }}' }">
                <div class="sticky top-0 z-10 overflow-hidden">
                  <div class="relative mb-6 lg:mb-10 rounded-xl overflow-hidden bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-700">
                    <img x-bind:src="mainImage" alt="{{ $product->name }}" class="object-cover w-full h-[400px]">
                  </div>
                  
                  @if(is_array($product->images) && count($product->images) > 1)
                      <div class="flex flex-wrap gap-3">
                        @foreach($product->images as $img)
                            <div class="w-20 h-20 rounded-lg overflow-hidden border cursor-pointer hover:border-blue-500" x-on:click="mainImage='{{ url('storage/' . $img) }}'">
                              <img src="{{ url('storage/' . $img) }}" alt="" class="object-cover w-full h-full">
                            </div>
                        @endforeach
                      </div>
                  @endif

                  <div class="px-6 pb-6 mt-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center space-x-3 mt-6 text-slate-700 dark:text-slate-300">
                      <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>
                      <span class="font-semibold text-sm">Free Express Shipping & 30-Day Returns</span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Details Section -->
              <div class="w-full px-4 md:w-1/2">
                <div class="lg:pl-10">
                  <div class="mb-6">
                    <div class="text-xs uppercase font-bold text-blue-600 mb-2">
                        {{ $product->category->name ?? 'General Category' }}
                    </div>
                    <h1 class="text-3xl font-extrabold text-slate-800 dark:text-slate-100 mb-4">
                        {{ $product->name }}
                    </h1>
                    
                    <div class="flex items-center space-x-4 mb-6">
                        <x-price-tag :amount="$product->price" />
                        <x-rating-stars :rating="$product->average_rating" />
                    </div>

                    <div class="prose dark:prose-invert max-w-none text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-6">
                      {!! Str::markdown($product->description ?? 'High quality product.') !!}
                    </div>
                  </div>

                  <!-- Product Variants (if available) -->
                  @if($product->variants->isNotEmpty())
                      <div class="mb-6">
                          <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Select Variant</label>
                          <div class="flex flex-wrap gap-2">
                              @foreach($product->variants as $variant)
                                  <button type="button" wire:click="$set('selectedVariantId', {{ $variant->id }})" class="px-3 py-1.5 rounded-md border text-sm font-medium transition-colors {{ $selectedVariantId === $variant->id ? 'border-blue-600 bg-blue-50 text-blue-600' : 'border-slate-300 dark:border-slate-700' }}">
                                      {{ $variant->name }} ({{ $variant->price ? '$' . number_format($variant->price, 2) : '$' . number_format($product->price, 2) }})
                                  </button>
                              @endforeach
                          </div>
                      </div>
                  @endif

                  <!-- Quantity Controls -->
                  <div class="w-40 mb-6">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Quantity</label>
                    <div class="flex items-center border border-slate-300 dark:border-slate-700 rounded-lg overflow-hidden">
                      <button wire:click="decreaseQuantity" class="px-3 py-2 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 text-lg font-bold">
                        -
                      </button>
                      <input type="text" readonly value="{{ $quantity }}" class="w-full text-center border-none bg-transparent font-bold text-slate-800 dark:text-slate-100">
                      <button wire:click="increaseQuantity" class="px-3 py-2 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 text-lg font-bold">
                        +
                      </button>
                    </div>
                  </div>

                  <div class="flex items-center space-x-4">
                    <button wire:click="addToCart" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-xl transition-colors shadow-lg shadow-blue-500/20">
                      Add to Cart
                    </button>
                    @livewire('wishlist-button', ['productId' => $product->id], key('dtl-wishlist-'.$product->id))
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- Customer Reviews Subsystem -->
        @livewire('product-reviews-component', ['product' => $product], key('reviews-'.$product->id))

        <!-- Product Questions and Answers -->
        @livewire('product-questions-component', ['productId' => $product->id], key('qa-'.$product->id))

        <!-- You May Also Like -->
        @livewire('related-products-widget', ['productId' => $product->id], key('related-'.$product->id))

        <!-- Recently Viewed Products -->
        @livewire('recently-viewed-products', ['currentProductId' => $product->id])

      </div>
</div>


