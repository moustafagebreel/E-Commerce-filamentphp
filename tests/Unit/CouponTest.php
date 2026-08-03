<?php

namespace Tests\Unit;

use App\Models\Coupon;
use PHPUnit\Framework\TestCase;

class CouponTest extends TestCase
{
    public function test_active_percentage_coupon_calculates_discount_correctly(): void
    {
        $coupon = new Coupon([
            'code' => 'TEST10',
            'type' => 'percent',
            'value' => 10,
            'min_amount' => 50,
            'is_active' => true,
        ]);

        $this->assertTrue($coupon->isValidForAmount(100));
        $this->assertEquals(10.0, $coupon->calculateDiscount(100));
    }

    public function test_coupon_invalid_when_order_subtotal_is_below_minimum(): void
    {
        $coupon = new Coupon([
            'code' => 'TEST10',
            'type' => 'percent',
            'value' => 10,
            'min_amount' => 100,
            'is_active' => true,
        ]);

        $this->assertFalse($coupon->isValidForAmount(50));
        $this->assertEquals(0, $coupon->calculateDiscount(50));
    }

    public function test_fixed_coupon_discount_calculation(): void
    {
        $coupon = new Coupon([
            'code' => 'FIXED20',
            'type' => 'fixed',
            'value' => 20,
            'min_amount' => 30,
            'is_active' => true,
        ]);

        $this->assertEquals(20.0, $coupon->calculateDiscount(100));
    }
}
