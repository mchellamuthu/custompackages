<?php

namespace Chella\Auditlogs;

use Chella\Auditlogs\Events\AuditLogEvent;
use Chella\Auditlogs\Listeners\AuditLogListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class AuditLogEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        AuditLogEvent::class => [
            AuditLogListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
