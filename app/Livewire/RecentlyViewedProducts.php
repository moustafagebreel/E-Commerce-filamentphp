<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class RecentlyViewedProducts extends Component
{
    public ?int $currentProductId = null;

    public function mount(?int $currentProductId = null)
    {
        $this->currentProductId = $currentProductId;

        if ($currentProductId) {
            $recent = session('recently_viewed_products', []);
            $recent = array_values(array_unique(array_merge([$currentProductId], $recent)));
            session(['recently_viewed_products' => array_slice($recent, 0, 10)]);
        }
    }

    public function render()
    {
        $recentIds = session('recently_viewed_products', []);
        if ($this->currentProductId) {
            $recentIds = array_diff($recentIds, [$this->currentProductId]);
        }

        $products = Product::whereIn('id', $recentIds)
            ->where('is_active', true)
            ->with(['category', 'reviews'])
            ->take(4)
            ->get();

        return view('livewire.recently-viewed-products', [
            'products' => $products,
        ]);
    }
}
