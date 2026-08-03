<div class="bg-blue-600 dark:bg-slate-800 rounded-2xl p-8 shadow-xl text-white my-10">
    <div class="max-w-xl mx-auto text-center space-y-4">
        <h3 class="text-2xl font-black">Subscribe & Get 10% Off Your First Order</h3>
        <p class="text-xs text-blue-100 dark:text-slate-300">Join our newsletter to receive exclusive discounts, flash deal updates, and new product releases directly in your inbox.</p>

        @if (session()->has('newsletter_success'))
            <div class="p-3 bg-green-500/20 border border-green-400 text-green-100 rounded-lg text-sm">
                {{ session('newsletter_success') }}
            </div>
        @endif

        <form wire:submit.prevent="subscribe" class="flex flex-col sm:flex-row gap-3 pt-2">
            <input type="email" wire:model="email" placeholder="Enter your email address..." class="flex-1 px-4 py-3 rounded-xl border-none text-slate-800 text-sm focus:ring-2 focus:ring-white">
            <button type="submit" class="bg-slate-900 hover:bg-black dark:bg-blue-500 dark:hover:bg-blue-600 text-white font-bold px-6 py-3 rounded-xl text-sm transition-colors">
                Subscribe Now
            </button>
        </form>
        @error('email') <span class="text-red-200 text-xs block text-left">{{ $message }}</span> @enderror
    </div>
</div>
