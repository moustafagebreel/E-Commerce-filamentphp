<?php

namespace App\Services;

use App\Models\UserWallet;
use App\Models\WalletTransaction;

class WalletService
{
    public static function getOrCreateWallet(int $userId): UserWallet
    {
        return UserWallet::firstOrCreate(
            ['user_id' => $userId],
            ['balance' => 0.00, 'points' => 0]
        );
    }

    public static function creditBalance(int $userId, float $amount, string $description, ?string $referenceId = null): UserWallet
    {
        $wallet = self::getOrCreateWallet($userId);
        $wallet->increment('balance', $amount);

        WalletTransaction::create([
            'user_wallet_id' => $wallet->id,
            'type' => 'credit',
            'amount' => $amount,
            'description' => $description,
            'reference_id' => $referenceId,
        ]);

        return $wallet;
    }

    public static function debitBalance(int $userId, float $amount, string $description, ?string $referenceId = null): bool
    {
        $wallet = self::getOrCreateWallet($userId);
        if ($wallet->balance < $amount) {
            return false;
        }

        $wallet->decrement('balance', $amount);

        WalletTransaction::create([
            'user_wallet_id' => $wallet->id,
            'type' => 'debit',
            'amount' => $amount,
            'description' => $description,
            'reference_id' => $referenceId,
        ]);

        return true;
    }

    public static function addLoyaltyPoints(int $userId, int $points): UserWallet
    {
        $wallet = self::getOrCreateWallet($userId);
        $wallet->increment('points', $points);
        return $wallet;
    }
}
