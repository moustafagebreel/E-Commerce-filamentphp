<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('My Dashboard - Apex E-Commerce Store')]
class CustomerDashboardPage extends Component
{
    public function render()
    {
        $user = Auth::user();

        $stats = [
            'total_orders' => Order::where('user_id', $user->id)->count(),
            'completed_orders' => Order::where('user_id', $user->id)->where('status', 'delivered')->count(),
            'pending_orders' => Order::where('user_id', $user->id)->whereIn('status', ['new', 'processing'])->count(),
            'total_spent' => Order::where('user_id', $user->id)->where('status', 'delivered')->sum('grand_total'),
        ];

        $recentOrders = Order::where('user_id', $user->id)
            ->with('items')
            ->latest()
            ->take(5)
            ->get();

        return view('livewire.customer-dashboard-page', [
            'stats' => $stats,
            'recentOrders' => $recentOrders,
            'user' => $user,
        ]);
    }
}
