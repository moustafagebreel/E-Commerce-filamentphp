<?php

namespace App\Services;

class ShippingCalculatorService
{
    public function execute(array $params = []): array
    {
        return [
            'status' => 'success',
            'service' => 'ShippingCalculatorService',
            'timestamp' => now()->toIso8601String(),
        ];
    }
}
