<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-slate-800 dark:text-slate-100">My Address Book</h1>
            <button wire:click="openNewForm" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg text-sm transition-colors">
                + Add New Address
            </button>
        </div>

        @if (session()->has('success'))
            <div class="p-4 mb-6 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                {{ session('success') }}
            </div>
        @endif

        @if($showForm)
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-6 shadow-sm mb-8">
                <h3 class="text-xl font-bold text-slate-800 dark:text-slate-200 mb-4">
                    {{ $editingAddressId ? 'Edit Address' : 'New Address' }}
                </h3>
                <form wire:submit.prevent="saveAddress" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-600 dark:text-slate-400 mb-1">First Name</label>
                        <input type="text" wire:model="first_name" class="w-full px-3 py-2 rounded-md border dark:bg-slate-800 dark:border-slate-700 text-slate-800 dark:text-slate-100 text-sm">
                        @error('first_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-600 dark:text-slate-400 mb-1">Last Name</label>
                        <input type="text" wire:model="last_name" class="w-full px-3 py-2 rounded-md border dark:bg-slate-800 dark:border-slate-700 text-slate-800 dark:text-slate-100 text-sm">
                        @error('last_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-600 dark:text-slate-400 mb-1">Phone Number</label>
                        <input type="text" wire:model="phone" class="w-full px-3 py-2 rounded-md border dark:bg-slate-800 dark:border-slate-700 text-slate-800 dark:text-slate-100 text-sm">
                        @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-600 dark:text-slate-400 mb-1">Street Address</label>
                        <input type="text" wire:model="street_address" class="w-full px-3 py-2 rounded-md border dark:bg-slate-800 dark:border-slate-700 text-slate-800 dark:text-slate-100 text-sm">
                        @error('street_address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-600 dark:text-slate-400 mb-1">City</label>
                        <input type="text" wire:model="city" class="w-full px-3 py-2 rounded-md border dark:bg-slate-800 dark:border-slate-700 text-slate-800 dark:text-slate-100 text-sm">
                        @error('city') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-600 dark:text-slate-400 mb-1">State / Province</label>
                        <input type="text" wire:model="state" class="w-full px-3 py-2 rounded-md border dark:bg-slate-800 dark:border-slate-700 text-slate-800 dark:text-slate-100 text-sm">
                        @error('state') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-slate-600 dark:text-slate-400 mb-1">ZIP / Postal Code</label>
                        <input type="text" wire:model="zip_code" class="w-full px-3 py-2 rounded-md border dark:bg-slate-800 dark:border-slate-700 text-slate-800 dark:text-slate-100 text-sm">
                        @error('zip_code') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-2 flex items-center space-x-3 pt-2">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2 rounded-md text-sm">
                            Save Address
                        </button>
                        <button type="button" wire:click="$set('showForm', false)" class="bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200 px-5 py-2 rounded-md text-sm">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($addresses as $addr)
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-5 shadow-sm relative">
                    <h4 class="font-bold text-slate-800 dark:text-slate-200 mb-2">
                        {{ $addr->first_name }} {{ $addr->last_name }}
                    </h4>
                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        {{ $addr->street_address ?? $addr->strret_address }}<br>
                        {{ $addr->city }}, {{ $addr->state }} {{ $addr->zip_code }}<br>
                        <span class="font-medium">Phone:</span> {{ $addr->phone }}
                    </p>

                    <div class="mt-4 flex items-center space-x-4 border-t border-slate-100 dark:border-slate-800 pt-3">
                        <button wire:click="editAddress({{ $addr->id }})" class="text-sm font-medium text-blue-600 hover:underline">
                            Edit
                        </button>
                        <button wire:click="deleteAddress({{ $addr->id }})" class="text-sm font-medium text-red-500 hover:underline">
                            Delete
                        </button>
                    </div>
                </div>
            @empty
                <div class="md:col-span-2 text-center py-12 bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800">
                    <p class="text-slate-500 text-sm">No addresses saved in your account.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
