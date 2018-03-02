<?php

namespace Webeleven\Rateable;

use Illuminate\Support\ServiceProvider;
use Webeleven\Rateable\Interfaces\UserProvider;
use Webeleven\Rateable\Middleware\RateableAuth;

class RateableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/routes.php';
        }

        $this->publishes([
            __DIR__.'/../config/rateable.php' => config_path('rateable.php')
        ], 'config');

//        $this->publishes([
//            __DIR__.'/migrations/' => database_path('migrations')
//        ], 'migrations');

        $this->app['router']->middleware('rateable.auth', RateableAuth::class);

        $this->app->singleton(RateableAuth::class, function () {
            return $this->app->make($this->app['config']->get('rateable.auth_middleware'));
        });

        $this->app->singleton(UserProvider::class, function () {
            return $this->app->make($this->app['config']->get('rateable.user_provider'));
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Webeleven\Rateable\Interfaces\RateRepositoryInterface', 'Webeleven\Rateable\Repositories\RateRepository');
        $this->app->singleton('Webeleven\Rateable\Interfaces\CommentRepositoryInterface', 'Webeleven\Rateable\Repositories\CommentRepository');
        $this->app->singleton('Webeleven\Rateable\Interfaces\VoteRepositoryInterface', 'Webeleven\Rateable\Repositories\VoteRepository');
    }
}
