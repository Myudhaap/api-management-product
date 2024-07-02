<?php

namespace App\Providers;

use App\Repositories\IAuthRepository;
use App\Repositories\Impl\AuthRepository;
use App\Services\IAuthService;
use App\Services\Impl\AuthService;
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
        $this->app->singleton(IAuthRepository::class, AuthRepository::class);
        $this->app->singleton(IAuthService::class, AuthService::class);
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
