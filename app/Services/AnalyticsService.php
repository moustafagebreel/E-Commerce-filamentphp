<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Carbon;

class AnalyticsService
{
    public static function getMonthlySalesData(): array
    {
        $months = [];
        $sales = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->format('M Y');
            $monthlyTotal = Order::where('payment_status', 'paid')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('grand_total');

            $months[] = $monthName;
            $sales[] = round($monthlyTotal, 2);
        }

        return [
            'labels' => $months,
            'data' => $sales,
        ];
    }

    public static function getOrderStatusBreakdown(): array
    {
        $statuses = ['new', 'processing', 'shipped', 'delivered', 'cancelled'];
        $counts = [];

        foreach ($statuses as $status) {
            $counts[$status] = Order::where('status', $status)->count();
        }

        return $counts;
    }

    public static function getAverageOrderValue(): float
    {
        $totalRevenue = Order::where('payment_status', 'paid')->sum('grand_total');
        $paidCount = Order::where('payment_status', 'paid')->count();

        return $paidCount > 0 ? round($totalRevenue / $paidCount, 2) : 0.0;
    }
}
