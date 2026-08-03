<?php

namespace App\Services;

use App\Models\ActivityLog;

class AuditLoggerService
{
    public static function log(string $action, ?string $description = null, ?int $userId = null): ActivityLog
    {
        return ActivityLog::create([
            'user_id' => $userId ?? auth()->id(),
            'action' => $action,
            'description' => $description,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
