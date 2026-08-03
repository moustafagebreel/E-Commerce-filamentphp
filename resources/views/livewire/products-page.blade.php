<div>
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <section class="py-10 bg-slate-50 font-poppins dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800">
          <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
            <div class="flex flex-wrap -mx-3">
              <!-- Sidebar Filters -->
              <div class="w-full pr-2 lg:w-1/4 lg:block">
                <!-- Categories Filter -->
                <div class="p-5 mb-5 bg-white rounded-xl border border-slate-200 dark:bg-slate-900 dark:border-slate-800 shadow-sm">
                  <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100">Categories</h2>
                  <div class="w-12 h-1 bg-blue-600 rounded my-3"></div>
                  <ul class="space-y-2">
                    @foreach($categories as $category)
                      <li>
                        <label class="flex items-center space-x-2 text-sm text-slate-700 dark:text-slate-300 cursor-pointer">
                          <input type="checkbox" wire:model.live="selected_categories" value="{{ $category->id }}" class="rounded text-blue-600 focus:ring-blue-500 border-slate-300 dark:border-slate-700 dark:bg-slate-800">
                          <span>{{ $category->name }}</span>
                        </label>
                      </li>
                    @endforeach
                  </ul>
                </div>

                <!-- Brands Filter -->
                <div class="p-5 mb-5 bg-white rounded-xl border border-slate-200 dark:bg-slate-900 dark:border-slate-800 shadow-sm">
                  <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100">Brands</h2>
                  <div class="w-12 h-1 bg-blue-600 rounded my-3"></div>
                  <ul class="space-y-2">
                    @foreach($brands as $brand)
                      <li>
                        <label class="flex items-center space-x-2 text-sm text-slate-700 dark:text-slate-300 cursor-pointer">
                          <input type="checkbox" wire:model.live="selected_brands" value="{{ $brand->id }}" class="rounded text-blue-600 focus:ring-blue-500 border-slate-300 dark:border-slate-700 dark:bg-slate-800">
                          <span>{{ $brand->name }}</span>
                        </label>
                      </li>
                    @endforeach
                  </ul>
                </div>

                <!-- Status Filter -->
                <div class="p-5 mb-5 bg-white rounded-xl border border-slate-200 dark:bg-slate-900 dark:border-slate-800 shadow-sm">
                  <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100">Product Status</h2>
                  <div class="w-12 h-1 bg-blue-600 rounded my-3"></div>
                  <ul class="space-y-2">
                    <li>
                      <label class="flex items-center space-x-2 text-sm text-slate-700 dark:text-slate-300 cursor-pointer">
                        <input type="checkbox" wire:model.live="featured" class="rounded text-blue-600 focus:ring-blue-500 border-slate-300 dark:border-slate-700 dark:bg-slate-800">
                        <span>Featured Items</span>
                      </label>
                    </li>
                    <li>
                      <label class="flex items-center space-x-2 text-sm text-slate-700 dark:text-slate-300 cursor-pointer">
                        <input type="checkbox" wire:model.live="on_sale" class="rounded text-blue-600 focus:ring-blue-500 border-slate-300 dark:border-slate-700 dark:bg-slate-800">
                        <span>On Sale Discounted</span>
                      </label>
                    </li>
                  </ul>
                </div>

                <!-- Price Range Filter -->
                <div class="p-5 bg-white rounded-xl border border-slate-200 dark:bg-slate-900 dark:border-slate-800 shadow-sm">
                  <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100">Max Price: ${{ number_format($price_range) }}</h2>
                  <div class="w-12 h-1 bg-blue-600 rounded my-3"></div>
                  <div>
                    <input type="range" wire:model.live="price_range" min="10" max="5000" step="50" class="w-full accent-blue-600 cursor-pointer">
                    <div class="flex justify-between text-xs font-bold text-slate-500 mt-2">
                      <span>$10</span>
                      <span>$5,000</span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Main Products Display Grid -->
              <div class="w-full px-3 lg:w-3/4">
                <div class="flex items-center justify-between bg-white dark:bg-slate-900 p-4 rounded-xl border border-slate-200 dark:border-slate-800 mb-6 shadow-sm">
                  <span class="text-sm font-semibold text-slate-600 dark:text-slate-400">Showing {{ $products->total() }} products</span>
                  <select wire:model.live="sort" class="text-sm bg-slate-50 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg px-3 py-1.5 font-medium text-slate-700 dark:text-slate-300">
                    <option value="latest">Sort by Latest</option>
                    <option value="price_asc">Price: Low to High</option>
                    <option value="price_desc">Price: High to Low</option>
                  </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                  @forelse($products as $product)
                    <x-product-card :product="$product" />
                  @empty
                    <div class="col-span-full text-center py-16 bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 text-slate-500">
                      No products match your active filters. Try resetting your search parameters.
                    </div>
                  @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                  {{ $products->links() }}
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
</div>
