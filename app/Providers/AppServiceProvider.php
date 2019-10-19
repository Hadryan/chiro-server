<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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

        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        // SMS provider
        $this->app->singleton(\App\Services\SMS\SmsInterface::class, \App\Services\SMS\Kavenegar::class);

        // JWT provider
        $this->app->singleton(\App\Services\JWT\JWTServiceInterface::class, function () {
            return new \App\Services\JWT\JWTService(config('jwt.jwt_key'));
        });

        // products
        $this->app->singleton(\App\Repository\ProductRepositoryInterface::class, \App\Repository\ProductRepository::class);
        $this->app->alias(\App\Repository\ProductRepositoryInterface::class, 'products');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
