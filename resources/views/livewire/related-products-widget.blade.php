@if($related->isNotEmpty())
<section class="py-10 mt-10">
    <h3 class="text-2xl font-extrabold text-slate-800 dark:text-slate-100 mb-6">You May Also Like</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($related as $product)
            <a href="/products/{{ $product->id }}" class="group block bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden">
                <div class="relative overflow-hidden h-48">
                    <img
                        src="{{ is_array($product->images) && count($product->images) > 0 ? url('storage/' . $product->images[0]) : 'https://via.placeholder.com/300x200?text=No+Image' }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        alt="{{ $product->name }}"
                    >
                    @if($product->on_sale)
                        <span class="absolute top-2 left-2 bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">SALE</span>
                    @endif
                </div>
                <div class="p-4">
                    <h4 class="font-bold text-sm text-slate-800 dark:text-slate-200 line-clamp-1 mb-1 group-hover:text-blue-600 transition-colors">{{ $product->name }}</h4>
                    <p class="text-xs text-slate-500 mb-2">{{ $product->category->name ?? '' }}</p>
                    <span class="font-black text-blue-600">${{ number_format($product->price, 2) }}</span>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endif
