<button wire:click.prevent="toggleWishlist" type="button" class="p-2.5 rounded-full transition-colors {{ $isInWishlist ? 'bg-red-50 text-red-600 dark:bg-red-900/30' : 'bg-slate-100 text-slate-500 hover:text-red-500 dark:bg-slate-800 dark:text-slate-400' }}" title="{{ $isInWishlist ? 'Remove from wishlist' : 'Add to wishlist' }}">
    <svg class="w-5 h-5 {{ $isInWishlist ? 'fill-current' : '' }}" stroke="currentColor" fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
    </svg>
</button>
