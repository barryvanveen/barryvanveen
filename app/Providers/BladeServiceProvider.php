<?php

namespace Barryvanveen\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Blade::directive('notempty', function ($expression) {
            return "<?php if(!empty($expression)): ?>";
        });

        Blade::directive('endnotempty', function () {
            return '<?php endif; ?>';
        });
    }

    /**
     * Register any application services.
     */
    public function register()
    {
    }
}
