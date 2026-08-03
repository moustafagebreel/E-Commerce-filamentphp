<?php

namespace App\Livewire;

use App\Models\Coupon;
use App\Services\CartService;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Shopping Cart - Apex E-Commerce Store')]
class CartPage extends Component
{
    public string $couponCode = '';
    public ?Coupon $appliedCoupon = null;

    public function mount()
    {
        $code = session('applied_coupon');
        if ($code) {
            $this->appliedCoupon = Coupon::where('code', $code)->first();
        }
    }

    public function increaseQty(int $productId)
    {
        $cart = CartService::getCart();
        foreach ($cart as &$item) {
            if ($item['product_id'] === $productId) {
                $item['quantity']++;
                $item['total_amount'] = $item['quantity'] * $item['unit_amount'];
            }
        }
        CartService::saveCart($cart);
    }

    public function decreaseQty(int $productId)
    {
        $cart = CartService::getCart();
        foreach ($cart as $key => &$item) {
            if ($item['product_id'] === $productId) {
                if ($item['quantity'] > 1) {
                    $item['quantity']--;
                    $item['total_amount'] = $item['quantity'] * $item['unit_amount'];
                } else {
                    unset($cart[$key]);
                }
            }
        }
        CartService::saveCart(array_values($cart));
    }

    public function removeItem(int $productId)
    {
        CartService::removeItem($productId);
        session()->flash('cart_message', 'Item removed from cart.');
    }

    public function applyCoupon()
    {
        $coupon = Coupon::where('code', strtoupper(trim($this->couponCode)))
            ->where('is_active', true)
            ->first();

        if (!$coupon || !$coupon->isValid()) {
            session()->flash('coupon_error', 'Invalid or expired coupon code.');
            return;
        }

        $subtotal = CartService::calculateGrandTotal();
        if ($coupon->min_spend && $subtotal < $coupon->min_spend) {
            session()->flash('coupon_error', "Minimum order amount of \${$coupon->min_spend} required.");
            return;
        }

        session(['applied_coupon' => $coupon->code]);
        $this->appliedCoupon = $coupon;
        session()->flash('coupon_success', 'Coupon code applied successfully!');
    }

    public function removeCoupon()
    {
        session()->forget('applied_coupon');
        $this->appliedCoupon = null;
        $this->couponCode = '';
        session()->flash('coupon_message', 'Coupon removed.');
    }

    public function render()
    {
        $cartItems = CartService::getCart();
        $subtotal = CartService::calculateGrandTotal();
        $discount = $this->appliedCoupon ? $this->appliedCoupon->calculateDiscount($subtotal) : 0;
        $grandTotal = max(0, $subtotal - $discount);

        return view('livewire.cart-page', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'grandTotal' => $grandTotal,
        ]);
    }
}
