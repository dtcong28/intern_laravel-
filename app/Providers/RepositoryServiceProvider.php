<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repository\TeamRepositoryInterface;
use App\Repository\Eloquent\TeamRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TeamRepositoryInterface::class, TeamRepository::class);
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
