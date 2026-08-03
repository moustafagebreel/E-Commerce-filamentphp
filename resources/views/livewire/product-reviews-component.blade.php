<div class="mt-12 bg-white dark:bg-slate-900 rounded-xl shadow p-6">
    <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-100 mb-6">Customer Reviews</h3>

    <!-- Summary Stats -->
    <div class="flex items-center space-x-4 mb-8">
        <div class="text-4xl font-extrabold text-amber-500">
            {{ number_format($product->average_rating, 1) }}
        </div>
        <div>
            <div class="flex items-center text-amber-400">
                @for ($i = 1; $i <= 5; $i++)
                    <svg class="w-5 h-5 {{ $i <= round($product->average_rating) ? 'fill-current' : 'text-slate-300 dark:text-slate-700' }}" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                @endfor
            </div>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                Based on {{ $product->reviews_count }} {{ Str::plural('review', $product->reviews_count) }}
            </p>
        </div>
    </div>

    <!-- Review Form -->
    @auth
        <form wire:submit.prevent="submitReview" class="mb-10 bg-slate-50 dark:bg-slate-800 p-6 rounded-lg border border-slate-200 dark:border-slate-700">
            <h4 class="text-lg font-semibold mb-4 text-slate-700 dark:text-slate-200">Write a Review</h4>
            
            @if (session()->has('review_success'))
                <div class="p-3 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                    {{ session('review_success') }}
                </div>
            @endif

            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Rating</label>
                <div class="flex items-center space-x-2">
                    @for ($star = 1; $star <= 5; $star++)
                        <button type="button" wire:click="$set('rating', {{ $star }})" class="focus:outline-none">
                            <svg class="w-7 h-7 {{ $star <= $rating ? 'text-amber-400 fill-current' : 'text-slate-300 dark:text-slate-600' }}" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </button>
                    @endfor
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Headline</label>
                <input type="text" wire:model="headline" class="w-full px-4 py-2 rounded-lg border dark:bg-slate-900 border-slate-300 dark:border-slate-700 focus:ring-blue-500 focus:border-blue-500" placeholder="Summary of your review">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Comment</label>
                <textarea wire:model="comment" rows="4" class="w-full px-4 py-2 rounded-lg border dark:bg-slate-900 border-slate-300 dark:border-slate-700 focus:ring-blue-500 focus:border-blue-500" placeholder="Detailed review..."></textarea>
                @error('comment') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-lg transition-colors">
                Submit Review
            </button>
        </form>
    @else
        <div class="p-4 mb-8 bg-slate-100 dark:bg-slate-800 rounded-lg text-slate-600 dark:text-slate-300 text-sm">
            Please <a href="{{ route('login') }}" class="text-blue-600 underline font-semibold">sign in</a> to write a review.
        </div>
    @endauth

    <!-- Existing Reviews List -->
    <div class="space-y-6">
        @forelse($reviews as $review)
            <div class="border-b border-slate-200 dark:border-slate-800 pb-6">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center space-x-3">
                        <span class="font-bold text-slate-800 dark:text-slate-200">{{ $review->user->name ?? 'Anonymous' }}</span>
                        <div class="flex text-amber-400">
                            @for ($star = 1; $star <= 5; $star++)
                                <svg class="w-4 h-4 {{ $star <= $review->rating ? 'fill-current' : 'text-slate-300 dark:text-slate-700' }}" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                    </div>
                    <span class="text-xs text-slate-400">{{ $review->created_at->diffForHumans() }}</span>
                </div>
                @if($review->headline)
                    <h5 class="font-semibold text-slate-700 dark:text-slate-300 mb-1">{{ $review->headline }}</h5>
                @endif
                <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">{{ $review->comment }}</p>
            </div>
        @empty
            <p class="text-slate-500 dark:text-slate-400 text-sm italic">No reviews yet for this product. Be the first to review!</p>
        @endforelse
    </div>
</div>
