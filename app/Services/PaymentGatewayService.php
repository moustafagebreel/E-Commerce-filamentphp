<?php

namespace App\Services;

class PaymentGatewayService
{
    public function execute(array $params = []): array
    {
        return [
            'status' => 'success',
            'service' => 'PaymentGatewayService',
            'timestamp' => now()->toIso8601String(),
        ];
    }
}
