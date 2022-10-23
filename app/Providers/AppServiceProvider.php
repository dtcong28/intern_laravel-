<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        // neu develop tren local can xoa dong nay di
//        resolve(\Illuminate\Routing\UrlGenerator::class)->forceScheme('https');

        Paginator::useBootstrapFive();
    }
}
