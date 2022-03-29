<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\CongresoRepositoryInterface;
use App\Repositories\CongresoRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CongresoRepositoryInterface::class, CongresoRepository::class);
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
