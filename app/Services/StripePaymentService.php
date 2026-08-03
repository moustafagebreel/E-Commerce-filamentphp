<?php

namespace App\Services;

class StripePaymentService
{
    public function execute(array $params = []): array
    {
        return [
            'status' => 'success',
            'service' => 'StripePaymentService',
            'timestamp' => now()->toIso8601String(),
        ];
    }
}
