<div class="bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl p-4 mt-4 text-xs">
    <div class="flex items-center justify-between mb-2">
        <span class="font-bold text-slate-700 dark:text-slate-300">📦 Estimate Shipping Rate</span>
        <span class="text-blue-600 font-bold">{{ $rateInfo['estimated_days'] }} Days Delivery</span>
    </div>

    <select wire:model.live="selected_zone_id" class="w-full bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-lg px-2.5 py-1.5 font-medium text-slate-700 dark:text-slate-200 mb-2">
        @foreach($zones as $zone)
            <option value="{{ $zone->id }}">{{ $zone->name }}</option>
        @endforeach
    </select>

    <div class="flex items-center justify-between pt-1">
        <span class="text-slate-500">Delivery Fee:</span>
        <span class="font-black text-sm {{ $rateInfo['is_free'] ? 'text-green-600' : 'text-slate-800 dark:text-slate-100' }}">
            {{ $rateInfo['is_free'] ? 'FREE SHIPPING' : '$' . number_format($rateInfo['cost'], 2) }}
        </span>
    </div>
</div>
