<div class="relative w-full max-w-md" x-data="{ open: true }" @click.outside="open = false">
    <div class="relative">
        <input 
            type="text" 
            wire:model.live.debounce.300ms="query" 
            @focus="open = true"
            placeholder="Search products..." 
            class="w-full pl-10 pr-4 py-2 rounded-full border border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-slate-800 dark:text-slate-100 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all"
        >
        <svg class="w-5 h-5 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
    </div>

    @if(strlen(trim($query)) >= 2)
        <div x-show="open" class="absolute left-0 right-0 mt-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl shadow-xl z-50 overflow-hidden max-h-96 overflow-y-auto">
            @forelse($results as $product)
                <a href="/products/{{ $product->slug }}" class="flex items-center space-x-3 p-3 hover:bg-slate-50 dark:hover:bg-slate-800 border-b border-slate-100 dark:border-slate-800 last:border-none transition-colors">
                    <img src="{{ is_array($product->images) && count($product->images) > 0 ? url('storage/' . $product->images[0]) : 'https://via.placeholder.com/80' }}" class="w-12 h-12 object-cover rounded-md flex-shrink-0">
                    <div class="flex-1 min-w-0">
                        <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-200 truncate">{{ $product->name }}</h4>
                        <p class="text-xs text-blue-600 dark:text-blue-400 font-bold">${{ number_format($product->price, 2) }}</p>
                    </div>
                </a>
            @empty
                <div class="p-4 text-center text-sm text-slate-500">
                    No products found for "{{ $query }}"
                </div>
            @endforelse
        </div>
    @endif
</div>
