<?php

namespace App\Console\Commands;

use App\Models\Coupon;
use Illuminate\Console\Command;

class ClearExpiredCouponsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coupons:clear-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivate all expired promotional coupons';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $count = Coupon::where('is_active', true)
            ->whereNotNull('expires_at')
            ->where('expires_at', '<', now())
            ->update(['is_active' => false]);

        $this->info("Successfully deactivated {$count} expired coupon(s).");
        return Command::SUCCESS;
    }
}
