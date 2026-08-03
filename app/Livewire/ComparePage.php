<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Compare Products - Apex E-Commerce Store')]
class ComparePage extends Component
{
    public array $comparedIds = [];

    public function mount()
    {
        $this->comparedIds = session('compared_products', []);
    }

    public function removeProduct(int $productId)
    {
        $this->comparedIds = array_values(array_diff($this->comparedIds, [$productId]));
        session(['compared_products' => $this->comparedIds]);
    }

    public function clearComparison()
    {
        session()->forget('compared_products');
        $this->comparedIds = [];
    }

    public function render()
    {
        $products = Product::whereIn('id', $this->comparedIds)
            ->with(['category', 'brand', 'reviews'])
            ->get();

        return view('livewire.compare-page', [
            'products' => $products,
        ]);
    }
}
