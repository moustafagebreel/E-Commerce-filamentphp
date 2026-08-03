<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductReview;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Home - Apex E-Commerce Store')]
class HomePage extends Component
{
    public function render()
    {
        $brands = Brand::where('is_active', true)->take(8)->get();
        $categories = Category::where('is_active', true)->take(8)->get();
        $featuredProducts = Product::where('is_active', true)->where('is_featured', true)->with(['category', 'reviews'])->take(8)->get();
        $latestReviews = ProductReview::where('is_approved', true)->with(['user', 'product'])->latest()->take(4)->get();

        return view('livewire.home-page', [
            'brands' => $brands,
            'categories' => $categories,
            'featuredProducts' => $featuredProducts,
            'latestReviews' => $latestReviews,
        ]);
    }
}
