@if($products->isNotEmpty())
    <section class="py-12 bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 rounded-2xl p-6 shadow-sm mt-12">
        <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-6">Recently Viewed Products</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </section>
@endif
