<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <!-- Brand Header -->
    <div class="flex items-center space-x-6 mb-10 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-6 rounded-2xl shadow-sm">
        @if($brand->image)
            <img src="{{ url('storage/' . $brand->image) }}" alt="{{ $brand->name }}" class="w-20 h-20 object-contain rounded-xl border p-2 bg-white">
        @endif
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 dark:text-slate-100">{{ $brand->name }} Products</h1>
            <p class="text-sm text-slate-500 mt-1">Browse all items by {{ $brand->name }}</p>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($products as $product)
            <x-product-card :product="$product" />
        @empty
            <div class="col-span-full text-center py-12 bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 text-slate-500">
                No products found for this brand.
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $products->links() }}
    </div>
</div>
