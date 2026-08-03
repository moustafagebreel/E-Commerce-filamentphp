<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    protected $model = Coupon::class;

    public function definition(): array
    {
        return [
            'code' => strtoupper($this->faker->unique()->lexify('CODE???')),
            'type' => $this->faker->randomElement(['fixed', 'percent']),
            'value' => $this->faker->numberBetween(5, 50),
            'min_amount' => $this->faker->numberBetween(20, 100),
            'usage_limit' => 100,
            'used_count' => 0,
            'starts_at' => now(),
            'expires_at' => now()->addMonths(2),
            'is_active' => true,
        ];
    }
}
