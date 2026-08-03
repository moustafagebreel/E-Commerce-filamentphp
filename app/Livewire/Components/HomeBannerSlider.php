<?php

namespace App\Livewire\Components;

use App\Models\Banner;
use Livewire\Component;

class HomeBannerSlider extends Component
{
    public function render()
    {
        $banners = Banner::where('is_active', true)
            ->where('position', 'hero')
            ->orderBy('sort_order')
            ->get();

        return view('livewire.components.home-banner-slider', [
            'banners' => $banners,
        ]);
    }
}
