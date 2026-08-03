<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $todaySales = Order::whereDate('created_at', today())->sum('grand_total');
        $todayOrders = Order::whereDate('created_at', today())->count();
        $totalProducts = Product::where('is_active', true)->count();
        $lowStock = Product::where('in_stock', false)->count();
        $newUsers = User::whereDate('created_at', today())->count();
        $pendingOrders = Order::where('status', 'new')->count();

        return [
            Stat::make('Today\'s Sales', '$' . number_format($todaySales, 2))
                ->description('Revenue earned today')
                ->color('success')
                ->icon('heroicon-o-banknotes'),

            Stat::make('Today\'s Orders', $todayOrders)
                ->description('New orders placed today')
                ->color('info')
                ->icon('heroicon-o-shopping-bag'),

            Stat::make('Active Products', $totalProducts)
                ->description($lowStock . ' out of stock')
                ->color($lowStock > 0 ? 'warning' : 'success')
                ->icon('heroicon-o-cube'),

            Stat::make('New Customers', $newUsers)
                ->description('Registered today')
                ->color('primary')
                ->icon('heroicon-o-users'),

            Stat::make('Pending Orders', $pendingOrders)
                ->description('Awaiting processing')
                ->color($pendingOrders > 5 ? 'danger' : 'warning')
                ->icon('heroicon-o-clock'),
        ];
    }
}
