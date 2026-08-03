<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Order Invoice - E-Commerce Store')]
class OrderInvoicePage extends Component
{
    public Order $order;

    public function mount($order)
    {
        if ($order instanceof Order) {
            $this->order = $order;
        } else {
            $this->order = Order::where('id', $order)
                ->where('user_id', Auth::id())
                ->firstOrFail();
        }

        $this->order->load(['items.product', 'address', 'user']);
    }

    public function render()
    {
        return view('livewire.order-invoice-page')->layout('layouts.app');
    }
}
