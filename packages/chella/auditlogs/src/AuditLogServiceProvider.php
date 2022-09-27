<?php

namespace Chella\AuditLogs;

use Illuminate\Support\ServiceProvider;
use Chella\Auditlogs\AuditLogEventServiceProvider;

class AuditLogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->register(AuditLogEventServiceProvider::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPublishing();
        $this->mergeConfigFrom(__DIR__ . '/../config/auditlog.php', 'auditlog');
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    private function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/auditlog.php' => base_path('config/auditlog.php'),
            ], 'config');

            if (!class_exists('CreateAuditLogsTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/audits.stub' => database_path(
                        sprintf('migrations/%s_create_audit_logs_table.php', date('Y_m_d_His'))
                    ),
                ], 'migrations');
            }
        }
    }

}
