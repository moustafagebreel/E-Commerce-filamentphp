<?php

namespace App\Services;

class EmailNotificationService
{
    public function execute(array $params = []): array
    {
        return [
            'status' => 'success',
            'service' => 'EmailNotificationService',
            'timestamp' => now()->toIso8601String(),
        ];
    }
}
