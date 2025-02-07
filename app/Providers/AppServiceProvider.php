<?php

namespace App\Providers;

use App\Models\Setting;
use App\Services\FileService;
use App\Services\Impl\FileServiceImpl;
use App\Services\Impl\UserAgentServiceImpl;
use App\Services\SettingsService;
use App\Services\UserAgentService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('settings', function () {
            return new SettingsService();
        });

        $this->app->singleton(FileService::class, FileServiceImpl::class);

        $this->app->singleton(UserAgentService::class, UserAgentServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        view()->composer('*', function ($view) {
            $view->with('settings', app('settings'));
        });
        //

        if (app()->environment('local')) { Artisan::call('route:clear'); }
    }
}
