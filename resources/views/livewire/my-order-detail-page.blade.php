<div>
<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-slate-800 dark:text-slate-100">Order #{{ $order->id }} Details</h1>
        @if(in_array($order->status, ['new', 'processing']))
            <button wire:click="$set('showCancelModal', true)" class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-lg text-sm transition-colors">
                Cancel Order
            </button>
        @endif
    </div>

    @if (session()->has('success'))
        <div class="p-4 mb-6 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="p-4 mb-6 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
            {{ session('error') }}
        </div>
    @endif

    <!-- Cards Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
      <div class="flex flex-col bg-white border border-slate-200 dark:border-slate-800 shadow-sm rounded-xl p-5 dark:bg-slate-900">
        <span class="text-xs uppercase font-semibold text-slate-400">Customer</span>
        <span class="text-lg font-bold text-slate-800 dark:text-slate-100 mt-1">{{ $order->user->name ?? 'Guest' }}</span>
      </div>

      <div class="flex flex-col bg-white border border-slate-200 dark:border-slate-800 shadow-sm rounded-xl p-5 dark:bg-slate-900">
        <span class="text-xs uppercase font-semibold text-slate-400">Order Date</span>
        <span class="text-lg font-bold text-slate-800 dark:text-slate-100 mt-1">{{ $order->created_at->format('d M Y, h:i A') }}</span>
      </div>

      <div class="flex flex-col bg-white border border-slate-200 dark:border-slate-800 shadow-sm rounded-xl p-5 dark:bg-slate-900">
        <span class="text-xs uppercase font-semibold text-slate-400">Order Status</span>
        <span class="inline-block mt-1 font-bold text-sm px-3 py-1 rounded-full uppercase {{ $order->status === 'delivered' ? 'bg-green-100 text-green-700' : ($order->status === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700') }}">
            {{ $order->status }}
        </span>
      </div>

      <div class="flex flex-col bg-white border border-slate-200 dark:border-slate-800 shadow-sm rounded-xl p-5 dark:bg-slate-900">
        <span class="text-xs uppercase font-semibold text-slate-400">Payment Status</span>
        <span class="inline-block mt-1 font-bold text-sm px-3 py-1 rounded-full uppercase {{ $order->payment_status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
            {{ $order->payment_status }}
        </span>
      </div>
    </div>

    <!-- Main Content -->
    <div class="flex flex-col lg:flex-row gap-6 mt-6">
      <div class="lg:w-3/4 space-y-6">
        <!-- Products Table -->
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl shadow-sm p-6 overflow-x-auto">
          <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100 mb-4">Items Ordered</h2>
          <table class="w-full text-left">
            <thead class="border-b border-slate-200 dark:border-slate-800 text-xs text-slate-400 uppercase">
              <tr>
                <th class="py-3">Product</th>
                <th class="py-3">Price</th>
                <th class="py-3">Qty</th>
                <th class="py-3 text-right">Total</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
              @foreach($order->items as $item)
                  <tr>
                    <td class="py-4 flex items-center space-x-3">
                      <img class="h-12 w-12 object-cover rounded-md" src="{{ is_array($item->product?->images) && count($item->product->images) > 0 ? url('storage/' . $item->product->images[0]) : 'https://via.placeholder.com/60' }}" alt="">
                      <span class="font-semibold text-slate-800 dark:text-slate-200">{{ $item->product?->name ?? 'Item' }}</span>
                    </td>
                    <td class="py-4 text-slate-600 dark:text-slate-400">${{ number_format($item->unit_amount, 2) }}</td>
                    <td class="py-4 text-slate-600 dark:text-slate-400">{{ $item->quantity }}</td>
                    <td class="py-4 text-right font-bold text-slate-800 dark:text-slate-100">${{ number_format($item->total_amount, 2) }}</td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <!-- Order Status Timeline -->
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl shadow-sm p-6">
          <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100 mb-4">Status Log & Timeline</h2>
          <div class="space-y-4">
              @forelse($order->status_logs as $log)
                  <div class="flex items-start space-x-3 border-l-2 border-blue-500 pl-4 py-1">
                      <div>
                          <span class="font-bold text-sm uppercase text-slate-800 dark:text-slate-200">{{ $log->status }}</span>
                          <span class="text-xs text-slate-400 ml-2">{{ $log->created_at->diffForHumans() }}</span>
                          <p class="text-sm text-slate-600 dark:text-slate-400 mt-0.5">{{ $log->notes }}</p>
                      </div>
                  </div>
              @empty
                  <p class="text-sm text-slate-500 italic">No status logs recorded yet.</p>
              @endforelse
          </div>
        </div>
      </div>

      <!-- Sidebar Summary -->
      <div class="lg:w-1/4 space-y-6">
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl shadow-sm p-6">
          <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100 mb-4">Order Summary</h2>
          <div class="space-y-3 text-sm">
            <div class="flex justify-between text-slate-600 dark:text-slate-400">
                <span>Shipping</span>
                <span>${{ number_format($order->shipping_amount, 2) }}</span>
            </div>
            @if($order->discount_amount > 0)
                <div class="flex justify-between text-green-600 font-semibold">
                    <span>Discount ({{ $order->coupon_code }})</span>
                    <span>-${{ number_format($order->discount_amount, 2) }}</span>
                </div>
            @endif
            <hr class="border-slate-200 dark:border-slate-800">
            <div class="flex justify-between font-extrabold text-base text-slate-800 dark:text-slate-100">
                <span>Grand Total</span>
                <span class="text-blue-600">${{ number_format($order->grand_total, 2) }}</span>
            </div>
          </div>
        </div>

        @if($order->address)
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl shadow-sm p-6">
              <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100 mb-2">Shipping Address</h2>
              <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                {{ $order->address->first_name }} {{ $order->address->last_name }}<br>
                {{ $order->address->street_address ?? $order->address->strret_address }}<br>
                {{ $order->address->city }}, {{ $order->address->state }} {{ $order->address->zip_code }}<br>
                <span class="font-semibold">Phone:</span> {{ $order->address->phone }}
              </p>
            </div>
        @endif
      </div>
    </div>
</div>

<!-- Cancel Order Modal -->
@if($showCancelModal)
    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-slate-900 rounded-xl p-6 max-w-md w-full shadow-2xl border border-slate-200 dark:border-slate-800">
            <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-2">Cancel Order #{{ $order->id }}</h3>
            <p class="text-sm text-slate-500 mb-4">Please provide a reason for cancelling this order.</p>

            <textarea wire:model="cancellationReason" rows="3" class="w-full p-3 rounded-lg border border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-sm mb-2" placeholder="Reason for cancellation..."></textarea>
            @error('cancellationReason') <span class="text-red-500 text-xs block mb-3">{{ $message }}</span> @enderror

            <div class="flex items-center space-x-3 mt-4">
                <button wire:click="cancelOrder" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-semibold py-2 rounded-lg text-sm">
                    Confirm Cancellation
                </button>
                <button wire:click="$set('showCancelModal', false)" class="bg-slate-200 dark:bg-slate-800 text-slate-700 dark:text-slate-300 font-semibold py-2 px-4 rounded-lg text-sm">
                    Back
                </button>
            </div>
        </div>
    </div>
@endif
</div>
