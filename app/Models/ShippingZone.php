<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingZone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'region_code',
        'base_rate',
        'free_shipping_threshold',
        'estimated_days',
        'is_active',
    ];

    protected $casts = [
        'base_rate' => 'float',
        'free_shipping_threshold' => 'float',
        'estimated_days' => 'integer',
        'is_active' => 'boolean',
    ];

    public function calculateShippingCost(float $subtotal): float
    {
        if ($this->free_shipping_threshold && $subtotal >= $this->free_shipping_threshold) {
            return 0.00;
        }

        return $this->base_rate;
    }
}
