<div>
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <h1 class="text-3xl font-bold text-slate-800 dark:text-slate-100 mb-6">Complete Your Order</h1>

        @if (session()->has('error'))
            <div class="p-4 mb-6 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-900/50 dark:text-red-200">
                {{ session('error') }}
            </div>
        @endif

        <form wire:submit.prevent="placeOrder">
            <div class="grid grid-cols-12 gap-8">
                <!-- Address & Payment Section -->
                <div class="col-span-12 lg:col-span-8 space-y-6">
                    <!-- Saved Addresses Quick Selection -->
                    @if($savedAddresses->isNotEmpty())
                        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-6 shadow-sm">
                            <h3 class="text-sm font-bold text-slate-800 dark:text-slate-200 mb-3">Saved Addresses</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach($savedAddresses as $addr)
                                    <div wire:click="selectAddress({{ $addr->id }})" class="p-3 border rounded-lg cursor-pointer transition-colors {{ $selected_address_id === $addr->id ? 'border-blue-600 bg-blue-50 dark:bg-slate-800' : 'border-slate-200 dark:border-slate-700' }}">
                                        <p class="font-bold text-xs text-slate-800 dark:text-slate-200">{{ $addr->first_name }} {{ $addr->last_name }}</p>
                                        <p class="text-xs text-slate-500 truncate">{{ $addr->street_address ?? $addr->strret_address }}, {{ $addr->city }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Shipping Address Inputs -->
                    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-6 shadow-sm">
                        <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100 mb-4">Shipping Information</h2>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 dark:text-slate-400 mb-1">First Name</label>
                                <input type="text" wire:model="first_name" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-sm">
                                @error('first_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 dark:text-slate-400 mb-1">Last Name</label>
                                <input type="text" wire:model="last_name" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-sm">
                                @error('last_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 dark:text-slate-400 mb-1">Phone Number</label>
                                <input type="text" wire:model="phone" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-sm">
                                @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 dark:text-slate-400 mb-1">Street Address</label>
                                <input type="text" wire:model="street_address" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-sm">
                                @error('street_address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 dark:text-slate-400 mb-1">City</label>
                                <input type="text" wire:model="city" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-sm">
                                @error('city') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 dark:text-slate-400 mb-1">State / Province</label>
                                <input type="text" wire:model="state" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-sm">
                                @error('state') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 dark:text-slate-400 mb-1">ZIP / Postal Code</label>
                                <input type="text" wire:model="zip_code" class="w-full px-3 py-2 rounded-lg border border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-sm">
                                @error('zip_code') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method Selection -->
                    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-6 shadow-sm">
                        <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100 mb-4">Select Payment Method</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="flex items-center p-4 border rounded-xl cursor-pointer transition-colors {{ $payment_method === 'cash_on_delivery' ? 'border-blue-600 bg-blue-50 dark:bg-slate-800' : 'border-slate-200 dark:border-slate-700' }}">
                                <input type="radio" wire:model.live="payment_method" value="cash_on_delivery" class="text-blue-600">
                                <div class="ml-3">
                                    <span class="block font-bold text-sm text-slate-800 dark:text-slate-200">Cash on Delivery</span>
                                    <span class="text-xs text-slate-400">Pay when your items are delivered</span>
                                </div>
                            </label>

                            <label class="flex items-center p-4 border rounded-xl cursor-pointer transition-colors {{ $payment_method === 'stripe' ? 'border-blue-600 bg-blue-50 dark:bg-slate-800' : 'border-slate-200 dark:border-slate-700' }}">
                                <input type="radio" wire:model.live="payment_method" value="stripe" class="text-blue-600">
                                <div class="ml-3">
                                    <span class="block font-bold text-sm text-slate-800 dark:text-slate-200">Credit Card (Stripe)</span>
                                    <span class="text-xs text-slate-400">Secure online card processing</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Order Basket & Summary Sidebar -->
                <div class="col-span-12 lg:col-span-4 space-y-6">
                    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-6 shadow-sm">
                        <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100 mb-4">Order Summary</h2>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between text-slate-600 dark:text-slate-400">
                                <span>Subtotal</span>
                                <span>${{ number_format($subtotal, 2) }}</span>
                            </div>
                            @if($discount > 0)
                                <div class="flex justify-between text-green-600 font-bold">
                                    <span>Discount</span>
                                    <span>-${{ number_format($discount, 2) }}</span>
                                </div>
                            @endif
                            <div class="flex justify-between text-slate-600 dark:text-slate-400">
                                <span>Shipping</span>
                                <span class="text-green-600 font-medium">FREE</span>
                            </div>
                            <hr class="border-slate-200 dark:border-slate-800">
                            <div class="flex justify-between font-black text-base text-slate-800 dark:text-slate-100">
                                <span>Grand Total</span>
                                <span class="text-blue-600">${{ number_format($grandTotal, 2) }}</span>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3.5 rounded-xl mt-6 transition-colors shadow-lg shadow-green-500/20">
                            Confirm Order →
                        </button>
                    </div>

                    <!-- Basket Items Overview -->
                    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-6 shadow-sm">
                        <h3 class="text-sm font-bold text-slate-800 dark:text-slate-200 mb-3">Items in Basket</h3>
                        <div class="divide-y divide-slate-100 dark:divide-slate-800 max-h-64 overflow-y-auto">
                            @foreach($cartItems as $item)
                                <div class="py-3 flex items-center justify-between text-xs">
                                    <div class="flex items-center space-x-3">
                                        <img src="{{ $item['image'] ? url('storage/' . $item['image']) : 'https://via.placeholder.com/60' }}" class="w-10 h-10 object-cover rounded-md">
                                        <div>
                                            <p class="font-bold text-slate-800 dark:text-slate-200 line-clamp-1">{{ $item['name'] }}</p>
                                            <p class="text-slate-400">Qty: {{ $item['quantity'] }}</p>
                                        </div>
                                    </div>
                                    <span class="font-bold text-slate-800 dark:text-slate-200">${{ number_format($item['total_amount'], 2) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
