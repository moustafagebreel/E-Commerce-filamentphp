<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Products Catalog - Apex E-Commerce Store')]
class ProductsPage extends Component
{
    use WithPagination;

    #[Url]
    public array $selected_categories = [];

    #[Url]
    public array $selected_brands = [];

    #[Url]
    public bool $featured = false;

    #[Url]
    public bool $on_sale = false;

    #[Url]
    public float $price_range = 3000;

    #[Url]
    public string $sort = 'latest';

    public function render()
    {
        $productQuery = Product::where('is_active', true);

        if (!empty($this->selected_categories)) {
            $productQuery->whereIn('category_id', $this->selected_categories);
        }

        if (!empty($this->selected_brands)) {
            $productQuery->whereIn('brand_id', $this->selected_brands);
        }

        if ($this->featured) {
            $productQuery->where('is_featured', true);
        }

        if ($this->on_sale) {
            $productQuery->where('on_sale', true);
        }

        if ($this->price_range) {
            $productQuery->where('price', '<=', $this->price_range);
        }

        if ($this->sort === 'price_asc') {
            $productQuery->orderBy('price', 'asc');
        } elseif ($this->sort === 'price_desc') {
            $productQuery->orderBy('price', 'desc');
        } else {
            $productQuery->latest();
        }

        return view('livewire.products-page', [
            'products' => $productQuery->paginate(9),
            'brands' => Brand::where('is_active', true)->get(),
            'categories' => Category::where('is_active', true)->get(),
        ]);
    }
}
