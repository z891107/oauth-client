<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Contracts\Factory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $socialite = $this->app->make(Factory::class);

        $socialite->extend('oauth', function () use ($socialite) {
            $config = config('services.oauth');

            return $socialite->buildProvider(SocialiteOauthProvider::class, $config);
        });
    }
}
