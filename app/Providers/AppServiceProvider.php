<?php

namespace App\Providers;

use App\Repositories\IAuthRepository;
use App\Repositories\ICategoryProductRepository;
use App\Repositories\Impl\AuthRepository;
use App\Repositories\Impl\CategoryProductRepository;
use App\Repositories\Impl\ProductRepository;
use App\Repositories\IProductRepository;
use App\Services\IAuthService;
use App\Services\ICategoryService;
use App\Services\Impl\AuthService;
use App\Services\Impl\CategoryProductService;
use App\Services\Impl\ProductService;
use App\Services\IProductService;
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
        $this->app->singleton(ICategoryProductRepository::class, CategoryProductRepository::class);
        $this->app->singleton(ICategoryService::class, CategoryProductService::class);
        $this->app->singleton(IProductRepository::class, ProductRepository::class);
        $this->app->singleton(IProductService::class, ProductService::class);
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
