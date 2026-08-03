<div>
    <button wire:click="$set('showModal', true)" class="w-full bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 px-4 rounded-xl text-sm transition-colors flex items-center justify-center space-x-2">
        <span>🔔</span>
        <span>Notify Me When In Stock</span>
    </button>

    @if($showModal)
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div class="bg-white dark:bg-slate-900 rounded-xl p-6 max-w-md w-full shadow-2xl border border-slate-200 dark:border-slate-800">
                <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-2">Back In Stock Notification</h3>
                <p class="text-xs text-slate-500 mb-4">Enter your email address to get notified instantly when this item is restocked.</p>

                <form wire:submit.prevent="subscribeAlert" class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 dark:text-slate-400 mb-1">Email Address</label>
                        <input type="email" wire:model="email" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-sm">
                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center space-x-3 pt-2">
                        <button type="submit" class="flex-1 bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 rounded-lg text-sm">
                            Subscribe Alert
                        </button>
                        <button type="button" wire:click="$set('showModal', false)" class="bg-slate-200 dark:bg-slate-800 text-slate-700 dark:text-slate-300 font-bold py-2 px-4 rounded-lg text-sm">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
