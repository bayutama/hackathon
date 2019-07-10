<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
		
		View::share('current_theme', getenv('TEMPLATE_THEME'));
		View::share('CSS_VERSION', getenv('CSS_VERSION'));
		View::share('JS_VERSION', getenv('JS_VERSION'));
		View::share('IMAGES_VERSION', getenv('IMAGES_VERSION'));
		View::share('FB_APP_ID', getenv('FB_APP_ID'));
		
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
