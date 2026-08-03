<div class="w-full max-w-[85rem] py-12 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 dark:text-slate-100">🏷️ Sale Products</h1>
            <p class="text-slate-500 text-sm mt-1">Big discounts on our hottest items — limited time!</p>
        </div>
        <select wire:model.live="sort" class="px-4 py-2 rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-900 text-sm font-semibold">
            <option value="latest">Latest First</option>
            <option value="price_asc">Price: Low to High</option>
            <option value="price_desc">Price: High to Low</option>
        </select>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-10">
        @forelse($products as $product)
            <a href="/products/{{ $product->id }}" class="group block bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden">
                <div class="relative overflow-hidden h-48">
                    <img
                        src="{{ is_array($product->images) && count($product->images) > 0 ? url('storage/' . $product->images[0]) : 'https://via.placeholder.com/300x200?text=No+Image' }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    >
                    <span class="absolute top-2 left-2 bg-red-500 text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full">SALE</span>
                </div>
                <div class="p-4">
                    <p class="text-xs text-slate-400 mb-1">{{ $product->category->name ?? '' }}</p>
                    <h4 class="font-bold text-sm text-slate-800 dark:text-slate-200 line-clamp-1 mb-2">{{ $product->name }}</h4>
                    <div class="flex items-center justify-between">
                        <span class="font-black text-red-600">${{ number_format($product->price, 2) }}</span>
                        <span class="text-xs {{ $product->in_stock ? 'text-green-500' : 'text-red-400' }} font-semibold">
                            {{ $product->in_stock ? 'In Stock' : 'Out of Stock' }}
                        </span>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-4 text-center py-20">
                <span class="text-4xl block mb-3">🏷️</span>
                <p class="text-slate-500">No sale products available at the moment. Check back soon!</p>
            </div>
        @endforelse
    </div>

    {{ $products->links() }}
</div>
