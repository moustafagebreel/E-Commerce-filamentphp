<div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 shadow-sm mt-8">
    <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-4">Product Questions & Answers</h3>

    @if (session()->has('question_success'))
        <div class="p-3 mb-4 text-xs text-green-700 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            {{ session('question_success') }}
        </div>
    @endif

    <!-- Question Submit Form -->
    <form wire:submit.prevent="askQuestion" class="mb-8">
        <textarea wire:model="questionText" rows="2" placeholder="Have a question about this product? Ask here..." class="w-full p-3 rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-sm mb-2"></textarea>
        @error('questionText') <span class="text-red-500 text-xs block mb-2">{{ $message }}</span> @enderror
        <button type="submit" class="bg-slate-800 dark:bg-slate-700 hover:bg-slate-900 text-white font-semibold px-5 py-2 rounded-lg text-xs transition-colors">
            Ask Question
        </button>
    </form>

    <!-- Q&A List -->
    <div class="space-y-4 divide-y divide-slate-100 dark:divide-slate-800">
        @forelse($questions as $q)
            <div class="pt-4">
                <div class="flex items-center space-x-2 text-xs text-slate-400 mb-1">
                    <span class="font-bold text-slate-700 dark:text-slate-300">Q: {{ $q->user->name ?? 'Customer' }}</span>
                    <span>• {{ $q->created_at->diffForHumans() }}</span>
                </div>
                <p class="font-semibold text-sm text-slate-800 dark:text-slate-200 mb-2">{{ $q->question }}</p>

                @if($q->answer)
                    <div class="bg-blue-50 dark:bg-slate-800/60 p-3 rounded-lg border-l-2 border-blue-500">
                        <span class="font-bold text-xs text-blue-600 dark:text-blue-400">Store Answer:</span>
                        <p class="text-xs text-slate-600 dark:text-slate-300 mt-1">{{ $q->answer }}</p>
                    </div>
                @else
                    <span class="text-[11px] text-slate-400 italic">Awaiting seller response...</span>
                @endif
            </div>
        @empty
            <p class="text-slate-500 text-xs italic py-2">No questions asked yet for this product.</p>
        @endforelse
    </div>
</div>
