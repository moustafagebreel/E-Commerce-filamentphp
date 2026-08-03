<?php

namespace App\Livewire;

use App\Models\ProductStockAlert;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BackInStockButton extends Component
{
    public int $productId;
    public string $email = '';
    public bool $showModal = false;

    public function mount(int $productId)
    {
        $this->productId = $productId;
        if (Auth::check()) {
            $this->email = Auth::user()->email;
        }
    }

    public function subscribeAlert()
    {
        $this->validate([
            'email' => 'required|email|max:255',
        ]);

        ProductStockAlert::updateOrCreate(
            ['product_id' => $this->productId, 'email' => strtolower(trim($this->email))],
            ['user_id' => Auth::id(), 'is_notified' => false]
        );

        $this->showModal = false;
        session()->flash('stock_alert_success', 'You will receive an email notification as soon as this product is back in stock!');
    }

    public function render()
    {
        return view('livewire.back-in-stock-button');
    }
}
