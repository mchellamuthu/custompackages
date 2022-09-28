<?php

namespace Chella\Auditlogs;

use Chella\Auditlogs\Events\AuditLogEvent;

class Auditor
{
    public static function log(
        string $action,
        ?string $message,
        ?object $resource,
        ?array $oldValues,
        ?array $newValues,
    ) {
        AuditLogEvent::dispatch([
            'action' => $action,
            'resource' => get_class($resource) ?? null,
            'resource_id' => $resource?->id ?? null,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'user_id' => auth()->id() ?? null,
            'message' => $message ?? null,
        ]);
    }
}
