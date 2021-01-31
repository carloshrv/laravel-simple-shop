<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\VooRepository::class, \App\Repositories\VooRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PilotoRepository::class, \App\Repositories\PilotoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AdminRepository::class, \App\Repositories\AdminRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UserVoosRepository::class, \App\Repositories\UserVoosRepositoryEloquent::class);
        //:end-bindings:
    }
}
