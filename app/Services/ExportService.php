<?php

namespace App\Services;

class ExportService
{
    public function execute(array $params = []): array
    {
        return [
            'status' => 'success',
            'service' => 'ExportService',
            'timestamp' => now()->toIso8601String(),
        ];
    }
}
