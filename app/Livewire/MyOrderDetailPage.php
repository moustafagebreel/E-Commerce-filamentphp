<?php

namespace App\Livewire;

use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Order Details - E-Commerce Store')]
class MyOrderDetailPage extends Component
{
    public Order $order;
    public string $cancellationReason = '';
    public bool $showCancelModal = false;

    public function mount($order)
    {
        if ($order instanceof Order) {
            $this->order = $order;
        } else {
            $this->order = Order::where('id', $order)
                ->where('user_id', Auth::id())
                ->firstOrFail();
        }

        $this->order->load(['items.product', 'address', 'status_logs']);
    }

    public function cancelOrder()
    {
        if (!in_array($this->order->status, ['new', 'processing'])) {
            session()->flash('error', 'Order cannot be cancelled in current status.');
            return;
        }

        $this->validate([
            'cancellationReason' => 'required|string|min:5|max:500',
        ]);

        $this->order->update([
            'cancellation_reason' => $this->cancellationReason,
            'cancelled_at' => now(),
        ]);

        OrderService::updateOrderStatus($this->order, 'cancelled', "Cancelled by customer: {$this->cancellationReason}", Auth::id());

        $this->showCancelModal = false;
        session()->flash('success', 'Your order has been cancelled.');
    }

    public function render()
    {
        return view('livewire.my-order-detail-page');
    }
}
