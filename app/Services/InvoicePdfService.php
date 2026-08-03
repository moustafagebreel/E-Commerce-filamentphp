<?php

namespace App\Services;

class InvoicePdfService
{
    public function execute(array $params = []): array
    {
        return [
            'status' => 'success',
            'service' => 'InvoicePdfService',
            'timestamp' => now()->toIso8601String(),
        ];
    }
}
