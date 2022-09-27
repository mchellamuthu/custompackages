<?php

namespace Chella\Auditlogs;

use Chella\Auditlogs\Events\AuditLogEvent;

class Auditor
{
    public static function log(
        string $action,
        string $message = null,
        string $resource = null,
        int $resource_id = null,
        array $old_values = null,
        array $new_values = null,
    ) {
        AuditLogEvent::dispatch([
            'action' => $action,
            'resource' => $resource ?? null,
            'resource_id' => $resource_id ?? null,
            'old_values' => $old_values,
            'new_values' => $new_values,
            'user_id' => auth()->id() ?? null,
            'message' => $message ?? null,
        ]);
    }
}
