<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Redirección HTTPS para Heroku
        if (env('REDIRECT_HTTPS')) {
            $this->app['request']->server->set('HTTPS', true);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        //Redirección HTTPS para Heroku
        if (env('REDIRECT_HTTPS')) {
            \URL::forceScheme('https');
            //$url->formatScheme('https://');
        }

        //Configurar el Schema por defecto
        Schema::defaultStringLength(191);
    }
}
