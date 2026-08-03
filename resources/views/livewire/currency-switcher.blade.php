<div x-data="{ open: false }" class="relative inline-block text-left">
    <button @click="open = !open" type="button" class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-xs font-bold text-slate-700 dark:text-slate-200 hover:bg-slate-50 transition-colors">
        <span>{{ $currentCurrency }}</span>
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>

    <div x-show="open" @click.outside="open = false" x-collapse class="absolute right-0 mt-2 w-28 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-lg shadow-lg z-50 overflow-hidden py-1">
        @foreach(['USD' => '$ USD', 'SAR' => 'ر.س SAR', 'EGP' => 'ج.م EGP', 'EUR' => '€ EUR', 'AED' => 'د.إ AED'] as $code => $label)
            <button wire:click="changeCurrency('{{ $code }}')" class="w-full text-left px-3 py-1.5 text-xs font-semibold text-slate-700 dark:text-slate-300 hover:bg-blue-50 dark:hover:bg-slate-800 transition-colors flex items-center justify-between">
                <span>{{ $label }}</span>
                @if($currentCurrency === $code)
                    <span class="text-blue-600 font-bold">✓</span>
                @endif
            </button>
        @endforeach
    </div>
</div>
