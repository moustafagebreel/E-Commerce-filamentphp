<?php

namespace App\Livewire;

use App\Models\GiftCard;
use Livewire\Component;

class GiftCardRedeemWidget extends Component
{
    public string $code = '';
    public ?string $successMessage = null;
    public ?string $errorMessage = null;

    public function redeem()
    {
        $this->validate([
            'code' => 'required|string|size:14',
        ]);

        $card = GiftCard::where('code', strtoupper(trim($this->code)))->first();

        if (!$card || !$card->isValid()) {
            $this->errorMessage = 'This gift card is invalid, expired, or already fully redeemed.';
            $this->successMessage = null;
            return;
        }

        // Credit the balance to the user's wallet
        \App\Services\WalletService::creditBalance(
            auth()->id(),
            $card->balance,
            'Gift card redeemed: ' . $card->code,
            $card->code
        );

        $card->update(['balance' => 0, 'is_active' => false]);

        $this->successMessage = "Gift card redeemed! \${$card->balance} has been credited to your wallet.";
        $this->errorMessage = null;
        $this->reset('code');
    }

    public function render()
    {
        return view('livewire.gift-card-redeem-widget');
    }
}
