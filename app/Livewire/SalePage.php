<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Sale Products - Apex E-Commerce Store')]
class SalePage extends Component
{
    use WithPagination;

    public string $sort = 'price_asc';

    public function updatedSort(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Product::where('is_active', true)
            ->where('on_sale', true)
            ->with(['category', 'brand', 'reviews']);

        $query = match ($this->sort) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'latest' => $query->latest(),
            default => $query->latest(),
        };

        return view('livewire.sale-page', [
            'products' => $query->paginate(12),
        ]);
    }
}
