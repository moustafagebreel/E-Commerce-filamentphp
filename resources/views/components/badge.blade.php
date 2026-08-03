@props(['color' => 'blue'])

@php
$colors = [
    'blue' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
    'green' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
    'red' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
    'yellow' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300',
    'gray' => 'bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-300',
];
$style = $colors[$color] ?? $colors['blue'];
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {$style}"]) }}>
    {{ $slot }}
</span>
