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
            $branches = Branch::paginate(10);
            $semesters = Semester::paginate(10);
            $view->with([
                'branches' => $branches,
                'semesters' => $semesters,
            ]);
        });
    }
}
