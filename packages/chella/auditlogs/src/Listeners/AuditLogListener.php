<?php

namespace Chella\Auditlogs\Listeners;

use Chella\Auditlogs\Events\AuditLogEvent;
use Chella\Auditlogs\Models\AuditLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AuditLogListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \Chella\Auditlogs\Events\AuditLogEvent  $event
     * @return void
     */
    public function handle(AuditLogEvent $event)
    {
        AuditLog::create($event->data);
    }
}
