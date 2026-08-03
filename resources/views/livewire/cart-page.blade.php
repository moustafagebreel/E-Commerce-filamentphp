<div>
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-slate-800 dark:text-slate-100">Your Shopping Cart</h1>

        @if (session()->has('cart_message'))
            <div class="p-4 mb-6 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                {{ session('cart_message') }}
            </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Cart Items Table -->
            <div class="lg:w-3/4">
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 overflow-x-auto rounded-xl shadow-sm p-6 mb-6">
                    <table class="w-full text-left">
                        <thead class="border-b border-slate-200 dark:border-slate-800 text-xs text-slate-400 uppercase">
                            <tr>
                                <th class="py-3">Product</th>
                                <th class="py-3">Price</th>
                                <th class="py-3">Quantity</th>
                                <th class="py-3">Total</th>
                                <th class="py-3 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                            @forelse($cartItems as $item)
                                <tr>
                                    <td class="py-4 flex items-center space-x-3">
                                        <img class="h-14 w-14 object-cover rounded-lg" src="{{ $item['image'] ? url('storage/' . $item['image']) : 'https://via.placeholder.com/80' }}" alt="">
                                        <a href="/products/{{ $item['product_id'] }}" class="font-semibold text-slate-800 dark:text-slate-200 hover:text-blue-600">
                                            {{ $item['name'] }}
                                        </a>
                                    </td>
                                    <td class="py-4 text-slate-600 dark:text-slate-400">${{ number_format($item['unit_amount'], 2) }}</td>
                                    <td class="py-4">
                                        <div class="flex items-center space-x-2 border border-slate-300 dark:border-slate-700 rounded-lg w-28 overflow-hidden">
                                            <button wire:click="decreaseQty({{ $item['product_id'] }})" class="px-2 py-1 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 font-bold hover:bg-slate-200">-</button>
                                            <span class="flex-1 text-center font-bold text-slate-800 dark:text-slate-200">{{ $item['quantity'] }}</span>
                                            <button wire:click="increaseQty({{ $item['product_id'] }})" class="px-2 py-1 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 font-bold hover:bg-slate-200">+</button>
                                        </div>
                                    </td>
                                    <td class="py-4 font-bold text-slate-800 dark:text-slate-100">${{ number_format($item['total_amount'], 2) }}</td>
                                    <td class="py-4 text-right">
                                        <button wire:click="removeItem({{ $item['product_id'] }})" class="text-xs text-red-600 hover:underline font-semibold">Remove</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-12 text-slate-500 italic">
                                        Your cart is empty. <a href="/products" class="text-blue-600 font-semibold underline">Continue shopping →</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Coupon Discount Code Form -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl shadow-sm p-6">
                    <h3 class="text-sm font-bold text-slate-800 dark:text-slate-200 mb-3">Have a Coupon Code?</h3>
                    @if (session()->has('coupon_error'))
                        <div class="p-3 mb-3 text-xs text-red-700 bg-red-100 rounded-lg dark:bg-red-900/50 dark:text-red-200">
                            {{ session('coupon_error') }}
                        </div>
                    @endif
                    @if (session()->has('coupon_success'))
                        <div class="p-3 mb-3 text-xs text-green-700 bg-green-100 rounded-lg dark:bg-green-900/50 dark:text-green-200">
                            {{ session('coupon_success') }}
                        </div>
                    @endif

                    @if($appliedCoupon)
                        <div class="flex items-center justify-between bg-green-50 dark:bg-green-950/40 border border-green-200 dark:border-green-800 p-3 rounded-lg">
                            <span class="text-sm font-bold text-green-700 dark:text-green-300">Applied Coupon: {{ $appliedCoupon->code }}</span>
                            <button wire:click="removeCoupon" class="text-xs text-red-600 font-semibold hover:underline">Remove Coupon</button>
                        </div>
                    @else
                        <form wire:submit.prevent="applyCoupon" class="flex gap-3">
                            <input type="text" wire:model="couponCode" placeholder="Enter promo code (e.g. SAVE20)" class="flex-1 px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-sm uppercase">
                            <button type="submit" class="bg-slate-800 dark:bg-slate-700 hover:bg-slate-900 text-white font-semibold px-5 py-2 rounded-lg text-sm transition-colors">
                                Apply
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Summary Box -->
            <div class="lg:w-1/4">
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl shadow-sm p-6 sticky top-6">
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

                    @if(count($cartItems) > 0)
                        <a href="/checkout" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl mt-6 transition-colors shadow-lg shadow-blue-500/20">
                            Proceed to Checkout →
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
