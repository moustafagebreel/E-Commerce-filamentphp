<div>
  <!-- Hero Section Slider -->
  <div class="w-full max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto pt-6">
    @livewire('components.home-banner-slider')

    @livewire('flash-sale-widget')
  </div>


  <!-- Brands Section -->
  <section class="py-12 bg-slate-50 dark:bg-slate-900 border-y border-slate-200 dark:border-slate-800">
    <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
      <div class="flex items-center justify-between mb-8">
        <div>
          <h2 class="text-2xl font-extrabold text-slate-800 dark:text-slate-100">Popular Brands</h2>
          <p class="text-slate-500 text-sm mt-1">Explore authentic electronics and fashion from top manufacturers</p>
        </div>
      </div>

      <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-6">
        @forelse($brands as $brand)
          <a href="/brands/{{ $brand->slug }}" class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-6 flex flex-col items-center justify-center hover:shadow-md transition-shadow group">
            @if($brand->image)
              <img src="{{ url('storage/' . $brand->image) }}" alt="{{ $brand->name }}" class="h-12 object-contain mb-3 group-hover:scale-110 transition-transform">
            @endif
            <span class="font-bold text-sm text-slate-700 dark:text-slate-200 group-hover:text-blue-600">{{ $brand->name }}</span>
          </a>
        @empty
          <div class="col-span-full text-slate-400 text-sm italic">No brands added yet.</div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- Categories Section -->
  <section class="py-16">
    <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
      <div class="flex items-center justify-between mb-8">
        <div>
          <h2 class="text-2xl font-extrabold text-slate-800 dark:text-slate-100">Browse Categories</h2>
          <p class="text-slate-500 text-sm mt-1">Find products organized by department</p>
        </div>
        <a href="/categories" class="text-blue-600 font-semibold text-sm hover:underline">View All →</a>
      </div>

      <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-6">
        @forelse($categories as $category)
          <a href="/products?category_id={{ $category->id }}" class="group flex items-center p-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl hover:shadow-md transition-all">
            <img src="{{ $category->image ? url('storage/' . $category->image) : 'https://via.placeholder.com/80' }}" class="w-14 h-14 object-cover rounded-lg mr-4">
            <div>
              <h3 class="font-bold text-slate-800 dark:text-slate-100 group-hover:text-blue-600">{{ $category->name }}</h3>
              <span class="text-xs text-slate-400">Explore Catalog</span>
            </div>
          </a>
        @empty
          <div class="col-span-full text-slate-400 text-sm italic">No categories added yet.</div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- Featured Products Section -->
  <section class="py-16 bg-slate-50 dark:bg-slate-900/50 border-t border-slate-200 dark:border-slate-800">
    <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
      <div class="flex items-center justify-between mb-8">
        <div>
          <h2 class="text-2xl font-extrabold text-slate-800 dark:text-slate-100">Featured Products</h2>
          <p class="text-slate-500 text-sm mt-1">Handpicked deals and trending items</p>
        </div>
        <a href="/products" class="text-blue-600 font-semibold text-sm hover:underline">Shop All Products →</a>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($featuredProducts as $product)
          <x-product-card :product="$product" />
        @empty
          <div class="col-span-full text-slate-400 text-sm italic">No featured products available.</div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- Newsletter Section -->
  <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
    @livewire('newsletter-form')
  </div>

  <!-- Customer Reviews Section -->

  @if($latestReviews->isNotEmpty())
    <section class="py-16">
      <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
        <h2 class="text-2xl font-extrabold text-slate-800 dark:text-slate-100 text-center mb-2">What Our Customers Say</h2>
        <p class="text-slate-500 text-center text-sm mb-10">Real feedback from verified buyers</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          @foreach($latestReviews as $review)
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-6 rounded-xl shadow-sm">
              <div class="flex items-center justify-between mb-3">
                <div class="flex items-center space-x-3">
                  <div class="w-10 h-10 rounded-full bg-blue-600 text-white font-bold flex items-center justify-center text-sm">
                    {{ strtoupper(substr($review->user->name ?? 'A', 0, 1)) }}
                  </div>
                  <div>
                    <h4 class="font-bold text-slate-800 dark:text-slate-200 text-sm">{{ $review->user->name ?? 'Customer' }}</h4>
                    <x-rating-stars :rating="$review->rating" />
                  </div>
                </div>
                <span class="text-xs text-slate-400">{{ $review->created_at->diffForHumans() }}</span>
              </div>
              <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">{{ $review->comment }}</p>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif
</div>
