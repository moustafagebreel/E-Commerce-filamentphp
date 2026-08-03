@props(['product'])

<div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow group flex flex-col justify-between">
    <div class="relative">
        <a href="/products/{{ $product->slug }}">
            <img src="{{ is_array($product->images) && count($product->images) > 0 ? url('storage/' . $product->images[0]) : 'https://via.placeholder.com/400' }}" alt="{{ $product->name }}" class="w-full h-52 object-cover group-hover:scale-105 transition-transform duration-300">
        </a>
        <div class="absolute top-3 right-3">
            @livewire('wishlist-button', ['productId' => $product->id], key('wishlist-'.$product->id))
        </div>
        @if($product->on_sale)
            <div class="absolute top-3 left-3 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded">
                SALE
            </div>
        @endif
    </div>
    <div class="p-4">
        <div class="text-xs text-slate-400 mb-1 uppercase font-semibold">
            {{ $product->category->name ?? 'Category' }}
        </div>
        <h3 class="font-bold text-slate-800 dark:text-slate-100 line-clamp-1 mb-2">
            <a href="/products/{{ $product->slug }}" class="hover:text-blue-600 transition-colors">
                {{ $product->name }}
            </a>
        </h3>
        <div class="flex items-center justify-between mt-3">
            <x-price-tag :amount="$product->price" />
            <x-rating-stars :rating="$product->average_rating" />
        </div>
    </div>
</div>
