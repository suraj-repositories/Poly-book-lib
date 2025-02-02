<?php

namespace App\Providers;

use App\Models\Branch;
use App\Models\Semester;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        $viewPath = resource_path('views/web');
        $views = [];

        foreach (glob("$viewPath/*.blade.php") as $file) {
            $viewName = str_replace([$viewPath . '/', '.blade.php'], ['', ''], $file);
            $views[] = "web.$viewName";
        }

        foreach (glob("$viewPath/**/*.blade.php", GLOB_BRACE) as $file) {
            $viewName = str_replace([$viewPath . '/', '.blade.php'], ['', ''], $file);
            $views[] = "web.$viewName";
        }

        View::composer($views, function ($view) {
            $branches = Branch::take(10)->get();
            $semesters = Semester::take(10)->get();
            $view->with([
                'branches' => $branches,
                'semesters' => $semesters,
            ]);
        });
    }
}
