<?php

namespace App\Services;

class DiscountCalculatorService
{
    public function execute(array $params = []): array
    {
        return [
            'status' => 'success',
            'service' => 'DiscountCalculatorService',
            'timestamp' => now()->toIso8601String(),
        ];
    }
}
