<?php

namespace App\Services;

use App\Models\SiteSetting;

class CurrencyService
{
    protected static array $rates = [
        'USD' => 1.0,
        'SAR' => 3.75,
        'EGP' => 48.50,
        'EUR' => 0.92,
        'AED' => 3.67,
    ];

    public static function format(float $amount, ?string $currency = null): string
    {
        $currency = $currency ?? SiteSetting::get('currency_code', 'USD');
        $symbol = SiteSetting::get('currency_symbol', '$');
        $rate = self::$rates[$currency] ?? 1.0;

        $converted = $amount * $rate;

        return $symbol . number_format($converted, 2);
    }

    public static function convert(float $amount, string $from, string $to): float
    {
        $fromRate = self::$rates[$from] ?? 1.0;
        $toRate = self::$rates[$to] ?? 1.0;

        $usdAmount = $amount / $fromRate;
        return round($usdAmount * $toRate, 2);
    }
}
