<?php

namespace App\Livewire;

use App\Models\Address;
use App\Models\Coupon;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Checkout - Apex E-Commerce Store')]
class CheckoutPage extends Component
{
    public string $first_name = '';
    public string $last_name = '';
    public string $phone = '';
    public string $street_address = '';
    public string $city = '';
    public string $state = '';
    public string $zip_code = '';
    public string $payment_method = 'cash_on_delivery';
    public ?int $selected_address_id = null;

    public function mount()
    {
        $user = Auth::user();
        if ($user) {
            $this->first_name = explode(' ', $user->name)[0] ?? '';
            $this->last_name = explode(' ', $user->name)[1] ?? '';
            $defaultAddress = $user->addresses()->latest()->first();
            if ($defaultAddress) {
                $this->selectAddress($defaultAddress->id);
            }
        }
    }

    public function selectAddress(int $addressId)
    {
        $addr = Address::find($addressId);
        if ($addr) {
            $this->selected_address_id = $addr->id;
            $this->first_name = $addr->first_name;
            $this->last_name = $addr->last_name;
            $this->phone = $addr->phone;
            $this->street_address = $addr->street_address ?? $addr->strret_address;
            $this->city = $addr->city;
            $this->state = $addr->state;
            $this->zip_code = $addr->zip_code;
        }
    }

    public function placeOrder()
    {
        $this->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
            'payment_method' => 'required|string|in:cash_on_delivery,stripe,paypal',
        ]);

        $cartItems = CartService::getCart();
        if (empty($cartItems)) {
            session()->flash('error', 'Your cart is empty.');
            return redirect()->route('cart');
        }

        $subtotal = CartService::calculateGrandTotal();
        $couponCode = session('applied_coupon');
        $coupon = $couponCode ? Coupon::where('code', $couponCode)->first() : null;
        $discount = $coupon ? $coupon->calculateDiscount($subtotal) : 0;
        $grandTotal = max(0, $subtotal - $discount);

        $addressData = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'street_address' => $this->street_address,
            'strret_address' => $this->street_address,
            'city' => $this->city,
            'state' => $this->state,
            'zip_code' => $this->zip_code,
        ];

        $orderData = [
            'user_id' => Auth::id(),
            'grand_total' => $grandTotal,
            'payment_method' => $this->payment_method,
            'payment_status' => $this->payment_method === 'cash_on_delivery' ? 'unpaid' : 'paid',
            'status' => 'new',
            'currency' => 'USD',
            'coupon_code' => $couponCode,
            'discount_amount' => $discount,
            'shipping_amount' => 0,
            'shipping_method' => 'free_shipping',
        ];

        $order = OrderService::createOrder($orderData, $cartItems, $addressData);
        CartService::clearCart();
        session()->forget('applied_coupon');

        return redirect()->route('success', ['order_id' => $order->id]);
    }

    public function render()
    {
        $user = Auth::user();
        $savedAddresses = $user ? $user->addresses()->latest()->get() : collect();
        $cartItems = CartService::getCart();
        $subtotal = CartService::calculateGrandTotal();
        $couponCode = session('applied_coupon');
        $coupon = $couponCode ? Coupon::where('code', $couponCode)->first() : null;
        $discount = $coupon ? $coupon->calculateDiscount($subtotal) : 0;
        $grandTotal = max(0, $subtotal - $discount);

        return view('livewire.checkout-page', [
            'savedAddresses' => $savedAddresses,
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'grandTotal' => $grandTotal,
        ]);
    }
}
