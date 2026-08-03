<?php

namespace App\Livewire;

use App\Models\FlashSale;
use Livewire\Component;

class FlashSaleWidget extends Component
{
    public function render()
    {
        $flashSale = FlashSale::where('is_active', true)
            ->where('end_time', '>', now())
            ->with(['products.category', 'products.reviews'])
            ->first();

        return view('livewire.flash-sale-widget', [
            'flashSale' => $flashSale,
        ]);
    }
}
