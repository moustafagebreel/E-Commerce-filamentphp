<?php

namespace App\Livewire;

use App\Services\WalletService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('My Wallet & Rewards - Apex E-Commerce Store')]
class CustomerWalletPage extends Component
{
    public float $addAmount = 50.00;

    public function topUpBalance()
    {
        $this->validate([
            'addAmount' => 'required|numeric|min:5|max:2000',
        ]);

        WalletService::creditBalance(Auth::id(), $this->addAmount, 'Manual wallet top-up via card payment');
        session()->flash('wallet_success', 'Wallet balance topped up successfully!');
    }

    public function convertPoints()
    {
        $wallet = WalletService::getOrCreateWallet(Auth::id());
        if ($wallet->points < 100) {
            session()->flash('wallet_error', 'Minimum 100 points required to convert to balance.');
            return;
        }

        $conversionRate = 100; // 100 points = $5.00
        $rewardDollar = ($wallet->points / $conversionRate) * 5.00;

        $wallet->decrement('points', $wallet->points);
        WalletService::creditBalance(Auth::id(), $rewardDollar, 'Loyalty points reward conversion');
        session()->flash('wallet_success', "Converted points into \${$rewardDollar} wallet balance!");
    }

    public function render()
    {
        $wallet = WalletService::getOrCreateWallet(Auth::id());
        $transactions = $wallet->transactions()->latest()->take(10)->get();

        return view('livewire.customer-wallet-page', [
            'wallet' => $wallet,
            'transactions' => $transactions,
        ]);
    }
}
