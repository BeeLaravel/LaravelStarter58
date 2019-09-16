<?php
namespace App\Providers;

class AppServiceProvider extends \Illuminate\Support\ServiceProvider {
    public function register() {
        \Illuminate\Support\Facades\Schema::defaultStringLength(191); // 兼容老版本 MySQL

        if ( config('app.debug') ) $this->app->register('VIACreative\SudoSu\ServiceProvider');
    }
    public function boot() {
    	// \Carbon\Carbon::setLocale('zh');

        $table = config('admin.extensions.config.table', 'admin_config'); // laravel-admin-ext/config
        if ( \Illuminate\Support\Facades\Schema::hasTable($table) ) \Encore\Admin\Config\Config::load();

        \Illuminate\Support\Facades\Queue::before(function (JobProcessing $event) {
            // $event->connectionName
            // $event->job
            // $event->job->payload()
        });
        \Illuminate\Support\Facades\Queue::after(function (JobProcessed $event) {
            // $event->connectionName
            // $event->job
            // $event->job->payload()
        });
        \Illuminate\Support\Facades\Queue::failing(function (JobFailed $event) {
            // $event->connectionName
            // $event->job
            // $event->exception
        });
    }
}
