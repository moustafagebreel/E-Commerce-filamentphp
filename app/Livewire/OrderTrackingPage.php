<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Order Tracking - Apex E-Commerce Store')]
class OrderTrackingPage extends Component
{
    public string $trackingCode = '';
    public ?array $order = null;
    public bool $searched = false;

    public function track()
    {
        $this->validate([
            'trackingCode' => 'required|string|min:4|max:50',
        ]);

        $found = \App\Models\Order::where('id', $this->trackingCode)
            ->orWhere('payment_intent_id', $this->trackingCode)
            ->with(['items.product', 'user'])
            ->first();

        $this->searched = true;

        if ($found) {
            $this->order = [
                'id' => $found->id,
                'status' => $found->status,
                'total' => $found->grand_total,
                'created_at' => $found->created_at->format('d M Y'),
                'items_count' => $found->items->count(),
                'shipping_address' => $found->shipping_address,
            ];
        } else {
            $this->order = null;
        }
    }

    public function render()
    {
        return view('livewire.order-tracking-page');
    }
}
