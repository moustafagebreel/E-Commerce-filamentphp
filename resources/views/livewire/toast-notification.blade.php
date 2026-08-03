<div class="fixed bottom-5 right-5 z-50 space-y-3 max-w-sm w-full pointer-events-none">
    @foreach($toasts as $toast)
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition.duration.300ms class="pointer-events-auto flex items-center justify-between p-4 rounded-xl shadow-xl text-white text-sm font-semibold {{ $toast['type'] === 'error' ? 'bg-red-600' : ($toast['type'] === 'warning' ? 'bg-amber-500' : 'bg-slate-900 dark:bg-blue-600') }}">
            <div class="flex items-center space-x-3">
                <span>{{ $toast['type'] === 'error' ? '❌' : ($toast['type'] === 'warning' ? '⚠️' : '✅') }}</span>
                <span>{{ $toast['message'] }}</span>
            </div>
            <button wire:click="removeToast('{{ $toast['id'] }}')" class="ml-4 opacity-70 hover:opacity-100 font-black">✕</button>
        </div>
    @endforeach
</div>
