<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GenerateDailySalesReportCommand extends Command
{
    protected $signature = 'sales:daily-report';

    protected $description = 'Generate and log daily e-commerce sales summary report';

    public function handle(): int
    {
        $todayOrders = Order::whereDate('created_at', today())->get();
        $totalSales = $todayOrders->where('payment_status', 'paid')->sum('grand_total');
        $orderCount = $todayOrders->count();

        $summary = "Daily Sales Summary (" . date('Y-m-d') . "): Total Orders: {$orderCount}, Total Revenue: $" . number_format($totalSales, 2);

        Log::info($summary);
        $this->info($summary);

        return Command::SUCCESS;
    }
}
