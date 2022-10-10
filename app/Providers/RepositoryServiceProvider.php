<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repository\Eloquent\TeamRepository;
use App\Repository\Eloquent\EmployeeRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind( TeamRepository::class);
        $this->app->bind( EmployeeRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
