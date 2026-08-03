<div class="w-full max-w-2xl mx-auto py-16 px-4">
    <div class="text-center mb-10">
        <h1 class="text-4xl font-extrabold text-slate-800 dark:text-slate-100 mb-2">Track Your Order</h1>
        <p class="text-slate-500 text-sm">Enter your Order ID or Payment Reference to get real-time delivery updates.</p>
    </div>

    <!-- Search Form -->
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-8 shadow-sm mb-8">
        <form wire:submit.prevent="track" class="flex gap-3">
            <input
                type="text"
                wire:model="trackingCode"
                placeholder="e.g. 1234 or pi_xxxxxxxx"
                class="flex-1 px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-sm font-medium"
            >
            <button type="submit" wire:loading.attr="disabled" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-3 rounded-xl text-sm transition-colors">
                <span wire:loading.remove>Track Order</span>
                <span wire:loading>Searching...</span>
            </button>
        </form>
        @error('trackingCode') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
    </div>

    <!-- Results -->
    @if($searched)
        @if($order)
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm p-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <span class="text-xs text-slate-400 uppercase tracking-widest">Order ID</span>
                        <p class="font-black text-xl text-slate-800 dark:text-slate-100">#{{ $order['id'] }}</p>
                    </div>
                    <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase
                        @switch($order['status'])
                            @case('new') bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300 @break
                            @case('processing') bg-amber-100 text-amber-700 dark:bg-amber-900 dark:text-amber-300 @break
                            @case('shipped') bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-300 @break
                            @case('delivered') bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300 @break
                            @case('cancelled') bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300 @break
                            @default bg-slate-100 text-slate-700
                        @endswitch
                    ">
                        {{ ucfirst($order['status']) }}
                    </span>
                </div>

                <!-- Tracking Timeline -->
                <div class="relative pl-6 border-l-2 border-slate-200 dark:border-slate-700 space-y-6 mb-8">
                    @foreach(['new' => 'Order Placed', 'processing' => 'Processing', 'shipped' => 'Shipped', 'delivered' => 'Delivered'] as $step => $label)
                        @php
                            $statuses = ['new', 'processing', 'shipped', 'delivered'];
                            $currentIndex = array_search($order['status'], $statuses);
                            $stepIndex = array_search($step, $statuses);
                            $done = $stepIndex <= $currentIndex;
                        @endphp
                        <div class="relative flex items-center gap-4">
                            <div class="absolute -left-[25px] w-4 h-4 rounded-full border-2 {{ $done ? 'bg-blue-600 border-blue-600' : 'bg-white dark:bg-slate-900 border-slate-300 dark:border-slate-600' }}"></div>
                            <span class="text-sm font-{{ $done ? 'bold' : 'medium' }} {{ $done ? 'text-slate-800 dark:text-slate-100' : 'text-slate-400' }}">{{ $label }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-xs text-slate-400 block">Order Date</span>
                        <span class="font-semibold text-slate-700 dark:text-slate-300">{{ $order['created_at'] }}</span>
                    </div>
                    <div>
                        <span class="text-xs text-slate-400 block">Total Amount</span>
                        <span class="font-black text-blue-600">${{ number_format($order['total'], 2) }}</span>
                    </div>
                    <div>
                        <span class="text-xs text-slate-400 block">Items</span>
                        <span class="font-semibold text-slate-700 dark:text-slate-300">{{ $order['items_count'] }} item(s)</span>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-2xl p-10">
                <span class="text-4xl block mb-3">🔍</span>
                <h3 class="font-bold text-slate-800 dark:text-slate-200 mb-1">Order Not Found</h3>
                <p class="text-xs text-slate-500">We couldn't locate an order matching that code. Please check and try again.</p>
            </div>
        @endif
    @endif
</div>
