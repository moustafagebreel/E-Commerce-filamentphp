<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\User;
use App\Services\OrderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_order_creation_transaction(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['price' => 50.00]);

        $cartItems = [
            [
                'product_id' => $product->id,
                'quantity' => 2,
                'unit_amount' => 50.00,
                'total_amount' => 100.00,
            ]
        ];

        $addressData = [
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'phone' => '123456789',
            'street_address' => '123 Main St',
            'city' => 'New York',
            'state' => 'NY',
            'zip_code' => '10001',
        ];

        $order = OrderService::createOrder($user->id, $cartItems, $addressData, 'cod');

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'user_id' => $user->id,
            'grand_total' => 110.00, // 100 + 10 shipping
        ]);

        $this->assertDatabaseHas('order_status_logs', [
            'order_id' => $order->id,
            'status' => 'new',
        ]);
    }
}
