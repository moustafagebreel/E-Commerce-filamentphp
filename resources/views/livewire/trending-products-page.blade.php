<div class="w-full max-w-[85rem] py-12 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 dark:text-slate-100">🔥 Trending Products</h1>
            <p class="text-slate-500 text-sm mt-1">Our best-selling products, ranked by customer orders</p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($trending as $index => $product)
            <a href="/products/{{ $product->id }}" class="group relative block bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden">
                <!-- Rank Badge -->
                <div class="absolute top-3 left-3 z-10 w-8 h-8 flex items-center justify-center rounded-full text-xs font-black text-white
                    {{ $index === 0 ? 'bg-yellow-400' : ($index === 1 ? 'bg-slate-400' : ($index === 2 ? 'bg-amber-600' : 'bg-slate-700')) }}">
                    #{{ $index + 1 }}
                </div>

                <div class="relative overflow-hidden h-48">
                    <img
                        src="{{ is_array($product->images) && count($product->images) > 0 ? url('storage/' . $product->images[0]) : 'https://via.placeholder.com/300x200?text=No+Image' }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    >
                </div>

                <div class="p-4">
                    <h4 class="font-bold text-sm text-slate-800 dark:text-slate-200 line-clamp-1 mb-1">{{ $product->name }}</h4>
                    <p class="text-xs text-slate-400 mb-2">{{ $product->order_items_count }} orders</p>
                    <span class="font-black text-blue-600">${{ number_format($product->price, 2) }}</span>
                </div>
            </a>
        @empty
            <div class="col-span-4 text-center py-20 text-slate-500">
                <p>No trending products found yet.</p>
            </div>
        @endforelse
    </div>
</div>
