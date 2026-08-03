@if($banners->isNotEmpty())
    <div x-data="{ activeIndex: 0, total: {{ $banners->count() }} }" x-init="setInterval(() => { activeIndex = (activeIndex + 1) % total }, 5000)" class="relative w-full rounded-2xl overflow-hidden shadow-lg border border-slate-200 dark:border-slate-800 mb-10 bg-slate-900 text-white">
        <div class="relative h-[360px] md:h-[450px]">
            @foreach($banners as $index => $banner)
                <div x-show="activeIndex === {{ $index }}" x-transition.opacity.duration.500ms class="absolute inset-0 flex items-center p-8 md:p-16 bg-cover bg-center" style="background-image: linear-gradient(to right, rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.3)), url('{{ url('storage/' . $banner->image) }}')">
                    <div class="max-w-xl">
                        <h2 class="text-3xl md:text-5xl font-black mb-4 leading-tight">{{ $banner->title }}</h2>
                        @if($banner->subtitle)
                            <p class="text-slate-300 text-base md:text-lg mb-6 leading-relaxed">{{ $banner->subtitle }}</p>
                        @endif
                        @if($banner->link_url)
                            <a href="{{ $banner->link_url }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-3.5 rounded-xl shadow-lg transition-colors">
                                {{ $banner->button_text }}
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        @if($banners->count() > 1)
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                @foreach($banners as $index => $banner)
                    <button @click="activeIndex = {{ $index }}" class="w-3 h-3 rounded-full transition-colors" :class="activeIndex === {{ $index }} ? 'bg-blue-500 w-8' : 'bg-white/50'"></button>
                @endforeach
            </div>
        @endif
    </div>
@endif
