<?php

namespace App\Services;

use App\Models\ActionLog;
use Illuminate\Support\Facades\Auth;

class ActionLogger
{
    public static function log(string $action, string $entityType, int $entityId = null, array $details = []): void
    {
        ActionLog::query()
            ->create([
                'user_id' => Auth::id(),
                'action' => $action,
                'entity_type' => $entityType,
                'entity_id' => $entityId,
                'details' => json_encode($details)
            ]);
    }
}
