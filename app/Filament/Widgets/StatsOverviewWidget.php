<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalRevenue = Order::where('payment_status', 'paid')->sum('grand_total');
        $totalOrders = Order::count();
        $totalCustomers = User::count();
        $totalProducts = Product::where('is_active', true)->count();

        return [
            Stat::make('Total Revenue', '$' . number_format($totalRevenue, 2))
                ->description('Total paid earnings')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Total Orders', number_format($totalOrders))
                ->description('All customer orders')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary'),
            Stat::make('Registered Customers', number_format($totalCustomers))
                ->description('Active user accounts')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),
            Stat::make('Active Products', number_format($totalProducts))
                ->description('Items in store catalog')
                ->descriptionIcon('heroicon-m-cube')
                ->color('warning'),
        ];
    }
}
