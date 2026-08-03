<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;

class ProductDetailPage extends Component
{
    public Product $product;
    public int $quantity = 1;
    public ?int $selectedVariantId = null;

    public function mount($product)
    {
        if ($product instanceof Product) {
            $this->product = $product;
        } else {
            $this->product = Product::where('slug', $product)->firstOrFail();
        }

        $this->product->load(['category', 'brand', 'variants', 'reviews']);
    }

    public function increaseQuantity()
    {
        $this->quantity++;
    }

    public function decreaseQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        \App\Services\CartService::addCartItemToCookie($this->product->id, $this->quantity);
        $this->dispatch('cartUpdated');
        session()->flash('cart_success', 'Product added to cart!');
    }

    public function render()
    {
        return view('livewire.product-detail-page')->title($this->product->name . ' - E-Commerce Store');
    }
}
