<?php

namespace App\Services;

class PayPalPaymentService
{
    public function execute(array $params = []): array
    {
        return [
            'status' => 'success',
            'service' => 'PayPalPaymentService',
            'timestamp' => now()->toIso8601String(),
        ];
    }
}
