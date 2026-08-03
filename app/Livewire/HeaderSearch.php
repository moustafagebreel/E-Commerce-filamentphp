<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class HeaderSearch extends Component
{
    public string $query = '';

    public function render()
    {
        $results = collect();

        if (strlen(trim($this->query)) >= 2) {
            $results = Product::where('is_active', true)
                ->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->query . '%')
                      ->orWhere('description', 'like', '%' . $this->query . '%');
                })
                ->take(6)
                ->get();
        }

        return view('livewire.header-search', [
            'results' => $results,
        ]);
    }
}
