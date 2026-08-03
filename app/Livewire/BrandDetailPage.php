<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;

class BrandDetailPage extends Component
{
    public Brand $brand;

    public function mount($slug)
    {
        $this->brand = Brand::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        $products = Product::where('brand_id', $this->brand->id)
            ->where('is_active', true)
            ->with(['category', 'reviews'])
            ->paginate(12);

        return view('livewire.brand-detail-page', [
            'products' => $products,
        ])->title($this->brand->name . ' Products - E-Commerce Store');
    }
}
