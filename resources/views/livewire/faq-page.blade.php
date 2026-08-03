<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-slate-800 dark:text-slate-100 mb-2 text-center">Frequently Asked Questions</h1>
        <p class="text-slate-500 text-center mb-10">Find answers to common questions about orders, shipping, returns, and payments.</p>

        @forelse($faqCategories as $category => $faqs)
            <div class="mb-10">
                <h2 class="text-xl font-bold text-slate-800 dark:text-slate-200 mb-4 border-b border-slate-200 dark:border-slate-800 pb-2">
                    {{ $category }}
                </h2>
                <div class="space-y-4">
                    @foreach($faqs as $faq)
                        <div x-data="{ open: false }" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-5 shadow-sm">
                            <button @click="open = !open" class="w-full flex items-center justify-between text-left font-semibold text-slate-800 dark:text-slate-200 focus:outline-none">
                                <span>{{ $faq->question }}</span>
                                <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" x-collapse class="mt-3 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-100 dark:border-slate-800 pt-3">
                                {{ $faq->answer }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="text-center py-12 text-slate-500">No FAQs available at the moment.</div>
        @endforelse
    </div>
</div>
