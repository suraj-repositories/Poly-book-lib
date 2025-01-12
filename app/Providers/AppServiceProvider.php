<?php

namespace App\Providers;

use App\Models\Setting;
use App\Services\FileService;
use App\Services\Impl\FileServiceImpl;
use App\Services\SettingsService;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            $view->with('settings', app('settings'));
        });
        //
    }
}
