<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class RelatedProductsWidget extends Component
{
    public int $productId;

    public function mount(int $productId)
    {
        $this->productId = $productId;
    }

    public function render()
    {
        $product = Product::find($this->productId);

        // First try explicit related products
        $related = $product?->relatedProducts()->where('is_active', true)->take(4)->get();

        // Fallback: same category, exclude current
        if (!$related || $related->isEmpty()) {
            $related = Product::where('category_id', $product?->category_id)
                ->where('id', '!=', $this->productId)
                ->where('is_active', true)
                ->inRandomOrder()
                ->take(4)
                ->get();
        }

        return view('livewire.related-products-widget', [
            'related' => $related,
        ]);
    }
}
