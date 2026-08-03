<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Trending Products - Apex E-Commerce Store')]
class TrendingProductsPage extends Component
{
    public function render()
    {
        // Products with most order_items = trending
        $trending = Product::withCount('order_items')
            ->where('is_active', true)
            ->orderByDesc('order_items_count')
            ->take(12)
            ->get();

        return view('livewire.trending-products-page', [
            'trending' => $trending,
        ]);
    }
}
