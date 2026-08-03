@props(['amount', 'original' => null, 'currency' => '$'])

<div class="flex items-baseline space-x-2">
    <span class="text-xl font-extrabold text-blue-600 dark:text-blue-400">
        {{ $currency }}{{ number_format($amount, 2) }}
    </span>
    @if($original && $original > $amount)
        <span class="text-sm text-slate-400 line-through">
            {{ $currency }}{{ number_format($original, 2) }}
        </span>
    @endif
</div>
