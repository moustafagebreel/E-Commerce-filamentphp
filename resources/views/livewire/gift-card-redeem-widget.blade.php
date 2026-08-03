<div class="bg-gradient-to-r from-purple-600 to-pink-600 rounded-2xl p-6 shadow-xl text-white">
    <div class="flex items-center space-x-3 mb-4">
        <span class="text-2xl">🎁</span>
        <div>
            <h4 class="font-bold text-sm">Redeem Gift Card</h4>
            <p class="text-xs text-purple-200">Enter your gift card code to add funds to your wallet</p>
        </div>
    </div>

    @if($successMessage)
        <div class="bg-white/20 rounded-lg p-3 mb-4 text-xs font-semibold">✅ {{ $successMessage }}</div>
    @endif
    @if($errorMessage)
        <div class="bg-red-500/30 rounded-lg p-3 mb-4 text-xs font-semibold">❌ {{ $errorMessage }}</div>
    @endif

    <form wire:submit.prevent="redeem" class="flex gap-2">
        <input
            type="text"
            wire:model="code"
            placeholder="XXXX-XXXX-XXXX"
            maxlength="14"
            class="flex-1 px-3 py-2.5 rounded-xl text-slate-900 font-bold text-sm uppercase tracking-widest placeholder:normal-case placeholder:tracking-normal"
        >
        <button type="submit" class="bg-white text-purple-700 font-black px-4 py-2.5 rounded-xl text-sm hover:bg-purple-50 transition-colors">
            Redeem
        </button>
    </form>
    @error('code') <p class="text-xs text-pink-200 mt-2">{{ $message }}</p> @enderror
</div>
