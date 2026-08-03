@props(['title' => 'UI Component #15'])

<div class="p-4 bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
    <h5 class="font-bold text-slate-800 dark:text-slate-200 text-sm">{{ $title }}</h5>
    {{ $slot }}
</div>
