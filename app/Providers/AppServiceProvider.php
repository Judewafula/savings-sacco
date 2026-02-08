<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\View\Components\Banner;
use Illuminate\Support\Facades\URL; 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Share data with all views
        Blade::component('banner', Banner::class);

        // Share data with all views using a view composer
        view()->composer('*', function ($view) {
            $view->with('title', 'Your Title Here');
            $view->with('message', 'Your Message Here');
        });
{
    if(env('APP_ENV') === 'production') {
        URL::forceScheme('https');
    }
}

    }
}


