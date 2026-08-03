<div class="w-full max-w-4xl py-10 px-4 mx-auto">
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-8 shadow-sm print:shadow-none print:border-none">
        <!-- Printable Header -->
        <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800 pb-6 mb-6">
            <div>
                <h1 class="text-2xl font-black text-blue-600 dark:text-blue-400">APEX STORE INVOICE</h1>
                <p class="text-xs text-slate-500 mt-1">Tax Invoice #INV-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
            </div>
            <div class="text-right">
                <button onclick="window.print()" class="print:hidden bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg text-sm transition-colors mb-2">
                    🖨️ Print Invoice
                </button>
                <p class="text-xs text-slate-400">Date: {{ $order->created_at->format('d M Y') }}</p>
            </div>
        </div>

        <!-- Addresses Grid -->
        <div class="grid grid-cols-2 gap-8 mb-8 text-sm">
            <div>
                <h4 class="font-bold text-slate-400 uppercase text-xs mb-2">Billed To:</h4>
                <p class="font-bold text-slate-800 dark:text-slate-200">{{ $order->user->name ?? 'Customer' }}</p>
                <p class="text-slate-600 dark:text-slate-400">{{ $order->user->email ?? '' }}</p>
            </div>
            <div>
                <h4 class="font-bold text-slate-400 uppercase text-xs mb-2">Shipping Destination:</h4>
                @if($order->address)
                    <p class="text-slate-600 dark:text-slate-400">
                        {{ $order->address->first_name }} {{ $order->address->last_name }}<br>
                        {{ $order->address->street_address ?? $order->address->strret_address }}<br>
                        {{ $order->address->city }}, {{ $order->address->state }} {{ $order->address->zip_code }}<br>
                        Phone: {{ $order->address->phone }}
                    </p>
                @endif
            </div>
        </div>

        <!-- Items Table -->
        <table class="w-full text-left mb-8">
            <thead class="border-b border-slate-200 dark:border-slate-800 text-xs text-slate-400 uppercase">
                <tr>
                    <th class="py-3">Item Description</th>
                    <th class="py-3">Unit Price</th>
                    <th class="py-3">Qty</th>
                    <th class="py-3 text-right">Amount</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                @foreach($order->items as $item)
                    <tr>
                        <td class="py-3 font-semibold text-slate-800 dark:text-slate-200">{{ $item->product?->name ?? 'Product' }}</td>
                        <td class="py-3 text-slate-600 dark:text-slate-400">${{ number_format($item->unit_amount, 2) }}</td>
                        <td class="py-3 text-slate-600 dark:text-slate-400">{{ $item->quantity }}</td>
                        <td class="py-3 text-right font-bold text-slate-800 dark:text-slate-100">${{ number_format($item->total_amount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total Breakdown -->
        <div class="flex justify-end">
            <div class="w-64 space-y-2 text-sm">
                <div class="flex justify-between text-slate-600 dark:text-slate-400">
                    <span>Shipping</span>
                    <span>${{ number_format($order->shipping_amount, 2) }}</span>
                </div>
                @if($order->discount_amount > 0)
                    <div class="flex justify-between text-green-600 font-semibold">
                        <span>Discount</span>
                        <span>-${{ number_format($order->discount_amount, 2) }}</span>
                    </div>
                @endif
                <hr class="border-slate-200 dark:border-slate-800">
                <div class="flex justify-between font-black text-lg text-slate-800 dark:text-slate-100">
                    <span>Total Due</span>
                    <span class="text-blue-600">${{ number_format($order->grand_total, 2) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
