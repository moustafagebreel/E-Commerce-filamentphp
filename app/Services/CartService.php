<?php

namespace App\Services;

use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class CartService
{
    public static function getCartItemsFromCookie(): array
    {
        $cartItems = json_decode(Cookie::get('cart_items', '[]'), true);
        return is_array($cartItems) ? $cartItems : [];
    }

    public static function addCartItemToCookie(int $productId, int $qty = 1): array
    {
        $cartItems = self::getCartItemsFromCookie();
        $existingKey = null;

        foreach ($cartItems as $key => $item) {
            if ($item['product_id'] === $productId) {
                $existingKey = $key;
                break;
            }
        }

        if ($existingKey !== null) {
            $cartItems[$existingKey]['quantity'] += $qty;
            $cartItems[$existingKey]['total_amount'] = $cartItems[$existingKey]['quantity'] * $cartItems[$existingKey]['unit_amount'];
        } else {
            $product = Product::findOrFail($productId);
            $cartItems[] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'image' => is_array($product->images) && count($product->images) > 0 ? $product->images[0] : null,
                'quantity' => $qty,
                'unit_amount' => $product->price,
                'total_amount' => $product->price * $qty,
            ];
        }

        Cookie::queue('cart_items', json_encode($cartItems), 60 * 24 * 30); // 30 days
        return $cartItems;
    }

    public static function removeCartItemFromCookie(int $productId): array
    {
        $cartItems = self::getCartItemsFromCookie();

        foreach ($cartItems as $key => $item) {
            if ($item['product_id'] === $productId) {
                unset($cartItems[$key]);
            }
        }

        $cartItems = array_values($cartItems);
        Cookie::queue('cart_items', json_encode($cartItems), 60 * 24 * 30);
        return $cartItems;
    }

    public static function calculateGrandTotal(array $cartItems, ?string $couponCode = null): array
    {
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['total_amount'];
        }

        $discount = 0;
        if ($couponCode) {
            $coupon = Coupon::where('code', strtoupper($couponCode))->first();
            if ($coupon) {
                $discount = $coupon->calculateDiscount($subtotal);
            }
        }

        $shipping = $subtotal > 0 ? 10.00 : 0.00;
        $grandTotal = max(0, $subtotal - $discount + $shipping);

        return [
            'subtotal' => round($subtotal, 2),
            'discount' => round($discount, 2),
            'shipping' => round($shipping, 2),
            'grand_total' => round($grandTotal, 2),
        ];
    }
}
