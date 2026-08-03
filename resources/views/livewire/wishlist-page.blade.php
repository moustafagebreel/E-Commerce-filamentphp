<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-slate-800 dark:text-slate-100 mb-6">My Wishlist</h1>

        @if (session()->has('success'))
            <div class="p-4 mb-6 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                {{ session('success') }}
            </div>
        @endif

        @if($wishlists->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($wishlists as $item)
                    @if($item->product)
                        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl overflow-hidden shadow-sm flex flex-col justify-between">
                            <div>
                                <a href="/products/{{ $item->product->slug }}">
                                    <img src="{{ is_array($item->product->images) && count($item->product->images) > 0 ? url('storage/' . $item->product->images[0]) : 'https://via.placeholder.com/300' }}" alt="{{ $item->product->name }}" class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
                                </a>
                                <div class="p-4">
                                    <h3 class="font-semibold text-lg text-slate-800 dark:text-slate-100 line-clamp-1">
                                        <a href="/products/{{ $item->product->slug }}">{{ $item->product->name }}</a>
                                    </h3>
                                    <p class="text-blue-600 dark:text-blue-400 font-bold text-xl mt-2">
                                        ${{ number_format($item->product->price, 2) }}
                                    </p>
                                </div>
                            </div>
                            <div class="p-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                                <a href="/products/{{ $item->product->slug }}" class="text-sm font-medium text-blue-600 hover:underline">
                                    View Product
                                </a>
                                <button wire:click="removeFromWishlist({{ $item->id }})" class="text-sm text-red-500 hover:text-red-700 font-medium">
                                    Remove
                                </button>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <div class="text-center py-16 bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800">
                <svg class="w-16 h-16 mx-auto text-slate-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-slate-700 dark:text-slate-300">Your Wishlist is empty</h3>
                <p class="text-slate-500 text-sm mt-1 mb-6">Explore products and add items to your wishlist!</p>
                <a href="/products" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Explore Products
                </a>
            </div>
        @endif
    </div>
</div>
