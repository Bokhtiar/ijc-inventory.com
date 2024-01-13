<?php

namespace App\Providers;

use App\Models\Setting;
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
        view()->composer('*', function ($view) {
            $view->with('setting', Setting::where('setting_id', 1)->first());
        });

        Blade::directive('route', function ($expression) {
            return "<?php echo route ($expression); ?>";
        });

       

    }
}
