<?php

namespace Chella\AuditLogs\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $connection = config('auditlog.database_connection');
    protected $guarded = [];
    protected $casts = [
        'old_values'   => 'json',
        'new_values'   => 'json',
    ];
}
