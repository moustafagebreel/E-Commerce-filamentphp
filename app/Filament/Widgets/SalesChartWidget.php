<?php

namespace App\Filament\Widgets;

use App\Services\AnalyticsService;
use Filament\Widgets\ChartWidget;

class SalesChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Monthly Sales Trend ($)';

    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $trend = AnalyticsService::getMonthlySalesData();

        return [
            'datasets' => [
                [
                    'label' => 'Sales ($)',
                    'data' => $trend['data'],
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                ],
            ],
            'labels' => $trend['labels'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
