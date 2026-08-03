@if($flashSale && $flashSale->products->isNotEmpty())
    <div x-data="{
        endTime: new Date('{{ $flashSale->end_time->toIso8601String() }}').getTime(),
        hours: '00',
        minutes: '00',
        seconds: '00',
        updateTimer() {
            const now = new Date().getTime();
            const distance = this.endTime - now;
            if (distance > 0) {
                this.hours = String(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
                this.minutes = String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
                this.seconds = String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, '0');
            }
        }
    }" x-init="updateTimer(); setInterval(() => updateTimer(), 1000)" class="bg-gradient-to-r from-red-600 via-pink-600 to-rose-600 rounded-2xl p-6 shadow-xl mb-12 text-white">
        
        <div class="flex flex-col md:flex-row items-center justify-between border-b border-white/20 pb-4 mb-6">
            <div class="flex items-center space-x-3 mb-4 md:mb-0">
                <span class="text-3xl">⚡</span>
                <div>
                    <h2 class="text-2xl font-black tracking-wide uppercase">{{ $flashSale->title }}</h2>
                    <p class="text-xs text-rose-100">{{ $flashSale->description ?? 'Save up to ' . $flashSale->discount_percentage . '% off limited quantities' }}</p>
                </div>
            </div>

            <!-- Alpine Countdown Timer -->
            <div class="flex items-center space-x-2">
                <span class="text-xs font-bold uppercase tracking-wider text-rose-100 mr-2">Ends In:</span>
                <div class="bg-black/30 backdrop-blur-md px-3 py-1.5 rounded-lg text-center">
                    <span x-text="hours" class="font-black text-xl">00</span>
                    <span class="block text-[10px] uppercase text-rose-200">Hours</span>
                </div>
                <span class="font-bold text-xl">:</span>
                <div class="bg-black/30 backdrop-blur-md px-3 py-1.5 rounded-lg text-center">
                    <span x-text="minutes" class="font-black text-xl">00</span>
                    <span class="block text-[10px] uppercase text-rose-200">Mins</span>
                </div>
                <span class="font-bold text-xl">:</span>
                <div class="bg-black/30 backdrop-blur-md px-3 py-1.5 rounded-lg text-center">
                    <span x-text="seconds" class="font-black text-xl">00</span>
                    <span class="block text-[10px] uppercase text-rose-200">Secs</span>
                </div>
            </div>
        </div>

        <!-- Deals Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($flashSale->products as $product)
                <div class="bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-100 rounded-xl p-4 shadow-md relative group">
                    <span class="absolute top-3 left-3 bg-red-600 text-white text-[10px] font-black px-2 py-0.5 rounded-full z-10">
                        -{{ $flashSale->discount_percentage }}% OFF
                    </span>

                    <img src="{{ is_array($product->images) && count($product->images) > 0 ? url('storage/' . $product->images[0]) : 'https://via.placeholder.com/200' }}" class="w-full h-40 object-cover rounded-lg mb-3 group-hover:scale-105 transition-transform">

                    <h4 class="font-bold text-sm line-clamp-1 mb-1">{{ $product->name }}</h4>
                    <div class="flex items-center space-x-2 mb-3">
                        <span class="font-black text-red-600 text-base">${{ number_format($product->price * (1 - ($flashSale->discount_percentage / 100)), 2) }}</span>
                        <span class="text-xs text-slate-400 line-through">${{ number_format($product->price, 2) }}</span>
                    </div>

                    <a href="/products/{{ $product->id }}" class="block text-center bg-slate-900 dark:bg-slate-800 hover:bg-red-600 text-white text-xs font-bold py-2 rounded-lg transition-colors">
                        Claim Deal →
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endif
