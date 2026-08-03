<?php

namespace Database\Seeders;

use App\Models\ShippingZone;
use Illuminate\Database\Seeder;

class ShippingZoneSeeder extends Seeder
{
    public function run(): void
    {
        $zones = [
            ['name' => 'Domestic Local Delivery', 'region_code' => 'LOCAL', 'base_rate' => 10.00, 'free_shipping_threshold' => 100.00, 'estimated_days' => 2],
            ['name' => 'National Standard Express', 'region_code' => 'NAT', 'base_rate' => 25.00, 'free_shipping_threshold' => 250.00, 'estimated_days' => 4],
            ['name' => 'GCC & Middle East Express', 'region_code' => 'GCC', 'base_rate' => 45.00, 'free_shipping_threshold' => 500.00, 'estimated_days' => 5],
            ['name' => 'Worldwide International Priority', 'region_code' => 'INTL', 'base_rate' => 85.00, 'free_shipping_threshold' => 1000.00, 'estimated_days' => 7],
        ];

        foreach ($zones as $zone) {
            ShippingZone::updateOrCreate(['name' => $zone['name']], $zone);
        }
    }
}
