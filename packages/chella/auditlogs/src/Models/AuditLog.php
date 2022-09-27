<?php

namespace Chella\Auditlogs\Models;

use Jenssegers\Mongodb\Eloquent\Model;


class AuditLog extends Model
{
    // protected $incrementing  =false;
    protected $connection = 'mongodb';
    protected $guarded = [];
}
