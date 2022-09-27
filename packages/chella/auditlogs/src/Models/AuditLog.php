<?php

namespace Chella\Auditlogs\Models;

use Jenssegers\Mongodb\Eloquent\Model;


class AuditLog extends Model
{


    protected $guarded = [];

    public function __construct()
    {
        $this->setConnection(config('auditlog.database_connection'));
        return parent::__construct();
    }
}
