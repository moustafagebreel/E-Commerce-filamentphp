<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class OrdersBarChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Orders by Status';

    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $statuses = ['new', 'processing', 'shipped', 'delivered', 'cancelled'];
        $counts = [];

        foreach ($statuses as $status) {
            $counts[] = Order::where('status', $status)->count();
        }

        return [
            'labels' => ['New', 'Processing', 'Shipped', 'Delivered', 'Cancelled'],
            'datasets' => [
                [
                    'label' => 'Orders',
                    'data' => $counts,
                    'backgroundColor' => [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(99, 102, 241, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                    ],
                    'borderRadius' => 6,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
