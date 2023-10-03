<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /* Register any application services. */
    public function register(): void
    { }

    /* Bootstrap any application services. */
    public function boot(): void
    {
        // view()->composer('*', function ($view) {
        //     $view->with('locations', Location::all());
        // });

        Blade::directive('route', function ($expression) {
            return "<?php echo route ($expression); ?>";
        });
    }
}
