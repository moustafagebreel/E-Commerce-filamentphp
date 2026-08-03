<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('New Arrivals - Apex E-Commerce Store')]
class NewArrivalsPage extends Component
{
    use WithPagination;

    public function render()
    {
        $products = Product::where('is_active', true)
            ->with(['category', 'brand', 'reviews'])
            ->latest()
            ->paginate(12);

        return view('livewire.new-arrivals-page', [
            'products' => $products,
        ]);
    }
}
