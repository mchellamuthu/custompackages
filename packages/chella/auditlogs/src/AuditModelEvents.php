<?php

namespace Chella\Auditlogs;

use Illuminate\Database\Eloquent\Model;

class AuditModelEvents
{
    public function __construct()
    {
    }

    public static function created(Model $model)
    {
        Auditor::log(
            action:'created',
            resource:$model,
        );
    }

    public static function updated(Model $model)
    {
        Auditor::log(
            action:'updated',
            resource:$model,
            oldValues:$model->getRawOriginal(),
            newValues:$model->getChanges(),
        );
    }

    public static function deleted(Model $model)
    {
        Auditor::log(
            action:'deleted',
            resource:$model,
            oldValues:$model->getRawOriginal(),
        );
    }
}
