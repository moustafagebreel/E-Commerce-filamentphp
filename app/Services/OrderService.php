<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Order_Item;
use App\Models\OrderStatusLog;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public static function createOrder(int $userId, array $cartItems, array $addressData, string $paymentMethod, ?string $couponCode = null): Order
    {
        return DB::transaction(function () use ($userId, $cartItems, $addressData, $paymentMethod, $couponCode) {
            $totals = CartService::calculateGrandTotal($cartItems, $couponCode);

            $order = Order::create([
                'user_id' => $userId,
                'status' => 'new',
                'grand_total' => $totals['grand_total'],
                'payment_method' => $paymentMethod,
                'payment_status' => 'pending',
                'currency' => 'USD',
                'coupon_code' => $couponCode,
                'discount_amount' => $totals['discount'],
                'shipping_amount' => $totals['shipping'],
                'shipping_method' => 'Standard Shipping',
            ]);

            foreach ($cartItems as $item) {
                Order_Item::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_amount' => $item['unit_amount'],
                    'total_amount' => $item['total_amount'],
                ]);
            }

            Address::create(array_merge($addressData, [
                'user_id' => $userId,
                'order_id' => $order->id,
            ]));

            OrderStatusLog::create([
                'order_id' => $order->id,
                'status' => 'new',
                'notes' => 'Order created successfully.',
                'changed_by' => $userId,
            ]);

            if ($couponCode) {
                Coupon::where('code', strtoupper($couponCode))->increment('used_count');
            }

            return $order;
        });
    }

    public static function updateOrderStatus(Order $order, string $newStatus, ?string $notes = null, ?int $changedBy = null): Order
    {
        $order->update(['status' => $newStatus]);

        OrderStatusLog::create([
            'order_id' => $order->id,
            'status' => $newStatus,
            'notes' => $notes ?? "Order status updated to {$newStatus}.",
            'changed_by' => $changedBy,
        ]);

        return $order;
    }
}
