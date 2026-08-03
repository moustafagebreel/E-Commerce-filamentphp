<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-3xl font-extrabold text-slate-800 dark:text-slate-100 mb-8">My Wallet & Loyalty Rewards</h1>

    @if (session()->has('wallet_success'))
        <div class="p-4 mb-6 text-sm text-green-700 bg-green-100 rounded-xl dark:bg-green-900/50 dark:text-green-200">
            {{ session('wallet_success') }}
        </div>
    @endif
    @if (session()->has('wallet_error'))
        <div class="p-4 mb-6 text-sm text-red-700 bg-red-100 rounded-xl dark:bg-red-900/50 dark:text-red-200">
            {{ session('wallet_error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
        <!-- Wallet Balance Card -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl p-8 shadow-xl text-white">
            <span class="text-xs uppercase font-bold tracking-widest text-blue-200">Current Balance</span>
            <div class="text-5xl font-black mt-2 mb-6">${{ number_format($wallet->balance, 2) }}</div>

            <form wire:submit.prevent="topUpBalance" class="flex gap-3">
                <input type="number" step="5" wire:model="addAmount" class="w-32 px-3 py-2 rounded-xl text-slate-900 font-bold text-sm">
                <button type="submit" class="bg-slate-900 hover:bg-black text-white font-bold px-5 py-2 rounded-xl text-sm transition-colors">
                    + Top Up Balance
                </button>
            </form>
        </div>

        <!-- Loyalty Points Card -->
        <div class="bg-gradient-to-r from-amber-500 to-orange-600 rounded-2xl p-8 shadow-xl text-white">
            <span class="text-xs uppercase font-bold tracking-widest text-amber-100">Reward Points</span>
            <div class="text-5xl font-black mt-2 mb-6">{{ number_format($wallet->points) }} <span class="text-xl">PTS</span></div>

            <button wire:click="convertPoints" class="bg-slate-900 hover:bg-black text-white font-bold px-6 py-2.5 rounded-xl text-sm transition-colors">
                Convert Points to Credit (100 PTS = $5)
            </button>
        </div>
    </div>

    <!-- Transaction History Table -->
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm p-6 overflow-x-auto">
        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100 mb-4">Transaction History</h3>
        <table class="w-full text-left">
            <thead class="border-b border-slate-200 dark:border-slate-800 text-xs text-slate-400 uppercase">
                <tr>
                    <th class="py-3">Type</th>
                    <th class="py-3">Description</th>
                    <th class="py-3">Amount</th>
                    <th class="py-3 text-right">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                @forelse($transactions as $tx)
                    <tr>
                        <td class="py-3">
                            <span class="font-bold text-xs uppercase px-2.5 py-1 rounded-full {{ $tx->type === 'credit' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $tx->type }}
                            </span>
                        </td>
                        <td class="py-3 text-slate-700 dark:text-slate-300 font-medium">{{ $tx->description }}</td>
                        <td class="py-3 font-bold {{ $tx->type === 'credit' ? 'text-green-600' : 'text-slate-800 dark:text-slate-100' }}">
                            {{ $tx->type === 'credit' ? '+' : '-' }}${{ number_format($tx->amount, 2) }}
                        </td>
                        <td class="py-3 text-right text-xs text-slate-400">{{ $tx->created_at->format('d M Y, h:i A') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-8 text-slate-500 italic">No wallet transactions recorded.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
