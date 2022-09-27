<?php

namespace Chella\Auditlogs;

use Chella\Auditlogs\Events\AuditLogEvent;

class Auditor
{
    public static function log(
        string $action,
        ?string $message,
        ?object $resource,
        ?int $resource_id,
        ?array $old_values,
        ?array $new_values,
    ) {
        AuditLogEvent::dispatch([
            'action' => $action,
            'resource' => get_class($resource) ?? null,
            'resource_id' => $resource?->id ?? null,
            'old_values' => $old_values,
            'new_values' => $new_values,
            'user_id' => auth()->id() ?? null,
            'message' => $message ?? null,
        ]);
    }
}
