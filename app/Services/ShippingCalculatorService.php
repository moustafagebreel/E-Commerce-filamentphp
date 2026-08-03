<?php

namespace App\Services;

use App\Models\ShippingZone;

class ShippingCalculatorService
{
    public static function getRateForZone(?int $zoneId, float $subtotal): array
    {
        if (!$zoneId) {
            $defaultZone = ShippingZone::where('is_active', true)->first();
            $zoneId = $defaultZone?->id;
        }

        $zone = ShippingZone::find($zoneId);

        if (!$zone) {
            return [
                'cost' => 15.00,
                'estimated_days' => 3,
                'is_free' => false,
                'zone_name' => 'Standard Shipping',
            ];
        }

        $cost = $zone->calculateShippingCost($subtotal);

        return [
            'cost' => $cost,
            'estimated_days' => $zone->estimated_days,
            'is_free' => $cost === 0.00,
            'zone_name' => $zone->name,
        ];
    }
}
