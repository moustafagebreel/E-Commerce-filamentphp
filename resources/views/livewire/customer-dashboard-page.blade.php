<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 dark:text-slate-100">My Dashboard</h1>
            <p class="text-slate-500 text-sm mt-1">Welcome back, <span class="font-bold text-blue-600">{{ $user->name }}</span> 👋</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 shadow-sm">
            <span class="text-2xl block mb-1">📦</span>
            <p class="text-xs text-slate-400 uppercase">Total Orders</p>
            <p class="text-3xl font-black text-slate-800 dark:text-slate-100">{{ $stats['total_orders'] }}</p>
        </div>
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 shadow-sm">
            <span class="text-2xl block mb-1">✅</span>
            <p class="text-xs text-slate-400 uppercase">Completed</p>
            <p class="text-3xl font-black text-green-600">{{ $stats['completed_orders'] }}</p>
        </div>
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 shadow-sm">
            <span class="text-2xl block mb-1">⏳</span>
            <p class="text-xs text-slate-400 uppercase">Pending</p>
            <p class="text-3xl font-black text-amber-500">{{ $stats['pending_orders'] }}</p>
        </div>
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 shadow-sm">
            <span class="text-2xl block mb-1">💰</span>
            <p class="text-xs text-slate-400 uppercase">Total Spent</p>
            <p class="text-3xl font-black text-blue-600">${{ number_format($stats['total_spent'], 0) }}</p>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-10">
        @foreach([
            ['icon' => '🛒', 'label' => 'My Orders', 'href' => '/my-orders'],
            ['icon' => '❤️', 'label' => 'Wishlist', 'href' => '/wishlist'],
            ['icon' => '💳', 'label' => 'My Wallet', 'href' => '/wallet'],
            ['icon' => '📍', 'label' => 'Addresses', 'href' => '/addresses'],
            ['icon' => '👤', 'label' => 'Profile', 'href' => '/profile'],
            ['icon' => '📦', 'label' => 'Track Order', 'href' => '/track-order'],
            ['icon' => '📝', 'label' => 'Store Policies', 'href' => '/policies'],
            ['icon' => '❓', 'label' => 'FAQ', 'href' => '/faq'],
        ] as $link)
            <a href="{{ $link['href'] }}" class="flex flex-col items-center justify-center gap-2 p-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl hover:border-blue-400 hover:shadow-md transition-all text-center group">
                <span class="text-2xl group-hover:scale-110 transition-transform">{{ $link['icon'] }}</span>
                <span class="text-xs font-bold text-slate-700 dark:text-slate-300">{{ $link['label'] }}</span>
            </a>
        @endforeach
    </div>

    <!-- Recent Orders -->
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 shadow-sm">
        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100 mb-4">Recent Orders</h3>
        <div class="divide-y divide-slate-100 dark:divide-slate-800">
            @forelse($recentOrders as $order)
                <div class="py-3 flex items-center justify-between">
                    <div>
                        <p class="font-bold text-sm text-slate-800 dark:text-slate-200">#{{ $order->id }}</p>
                        <p class="text-xs text-slate-400">{{ $order->created_at->format('d M Y') }} • {{ $order->items->count() }} items</p>
                    </div>
                    <div class="text-right">
                        <p class="font-black text-sm text-blue-600">${{ number_format($order->grand_total, 2) }}</p>
                        <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full
                            {{ match($order->status) {
                                'delivered' => 'bg-green-100 text-green-700',
                                'shipped' => 'bg-indigo-100 text-indigo-700',
                                'processing' => 'bg-amber-100 text-amber-700',
                                'cancelled' => 'bg-red-100 text-red-700',
                                default => 'bg-blue-100 text-blue-700'
                            } }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
            @empty
                <p class="text-sm text-slate-500 py-4 italic">No orders placed yet.</p>
            @endforelse
        </div>
    </div>
</div>
