<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class RevenueLineChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Revenue - Last 7 Days';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $days = collect(range(6, 0))->map(fn ($d) => Carbon::now()->subDays($d));

        $labels = $days->map(fn ($d) => $d->format('D d'))->toArray();

        $revenue = $days->map(function ($day) {
            return Order::whereDate('created_at', $day->toDateString())->sum('grand_total');
        })->toArray();

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Revenue ($)',
                    'data' => $revenue,
                    'borderColor' => '#6366f1',
                    'backgroundColor' => 'rgba(99, 102, 241, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
