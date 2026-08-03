<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="max-w-4xl mx-auto space-y-8">
        <h1 class="text-3xl font-bold text-slate-800 dark:text-slate-100">Account Profile & Settings</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Profile Info Form -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-bold text-slate-800 dark:text-slate-200 mb-4">Personal Information</h3>

                @if (session()->has('profile_success'))
                    <div class="p-3 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                        {{ session('profile_success') }}
                    </div>
                @endif

                <form wire:submit.prevent="updateProfile" class="space-y-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-600 dark:text-slate-400 mb-1">Full Name</label>
                        <input type="text" wire:model="name" class="w-full px-3 py-2 rounded-lg border dark:bg-slate-800 dark:border-slate-700 text-sm">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-600 dark:text-slate-400 mb-1">Email Address</label>
                        <input type="email" wire:model="email" class="w-full px-3 py-2 rounded-lg border dark:bg-slate-800 dark:border-slate-700 text-sm">
                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2 rounded-lg text-sm transition-colors">
                        Save Profile
                    </button>
                </form>
            </div>

            <!-- Password Update Form -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-bold text-slate-800 dark:text-slate-200 mb-4">Change Password</h3>

                @if (session()->has('password_success'))
                    <div class="p-3 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                        {{ session('password_success') }}
                    </div>
                @endif

                <form wire:submit.prevent="updatePassword" class="space-y-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-600 dark:text-slate-400 mb-1">Current Password</label>
                        <input type="password" wire:model="current_password" class="w-full px-3 py-2 rounded-lg border dark:bg-slate-800 dark:border-slate-700 text-sm">
                        @error('current_password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-600 dark:text-slate-400 mb-1">New Password</label>
                        <input type="password" wire:model="new_password" class="w-full px-3 py-2 rounded-lg border dark:bg-slate-800 dark:border-slate-700 text-sm">
                        @error('new_password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-600 dark:text-slate-400 mb-1">Confirm New Password</label>
                        <input type="password" wire:model="new_password_confirmation" class="w-full px-3 py-2 rounded-lg border dark:bg-slate-800 dark:border-slate-700 text-sm">
                    </div>

                    <button type="submit" class="bg-slate-800 dark:bg-slate-700 hover:bg-slate-900 text-white font-medium px-5 py-2 rounded-lg text-sm transition-colors">
                        Update Password
                    </button>
                </form>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-slate-800 dark:text-slate-200">Recent Orders</h3>
                <a href="/my-orders" class="text-sm font-semibold text-blue-600 hover:underline">View All Orders →</a>
            </div>

            <div class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($recentOrders as $order)
                    <div class="py-3 flex items-center justify-between">
                        <div>
                            <span class="font-bold text-slate-800 dark:text-slate-200">Order #{{ $order->id }}</span>
                            <span class="text-xs text-slate-400 ml-2">{{ $order->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="font-bold text-sm text-blue-600">${{ number_format($order->grand_total, 2) }}</span>
                            <a href="/my-orders/{{ $order->id }}" class="text-xs bg-slate-100 dark:bg-slate-800 px-3 py-1 rounded-md text-slate-700 dark:text-slate-300 font-medium">Details</a>
                        </div>
                    </div>
                @empty
                    <p class="text-slate-500 text-sm italic py-2">No orders placed yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
