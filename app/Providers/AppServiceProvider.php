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

        $this->app->singleton(\App\Services\SMS\SmsInterface::class, \App\Services\Sms\Kavenegar::class);
        $this->app->singleton(\App\Services\JWT\JWTServiceInterface::class, function () {
            return new \App\Services\JWT\JWTService(config('jwt.jwt_key'));
        });
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
