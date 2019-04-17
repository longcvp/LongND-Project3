<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\UserEloquentRepository;
use App\Repositories\UserConfirm\UserConfirmRepositoryInterface;
use App\Repositories\UserConfirm\UserConfirmEloquentRepository;
use App\Repositories\Store\StoreRepositoryInterface;
use App\Repositories\Store\StoreEloquentRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Product\ProductEloquentRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserEloquentRepository::class
        );

        $this->app->singleton(
            ProductRepositoryInterface::class,
            ProductEloquentRepository::class
        );

        $this->app->singleton(
            StoreRepositoryInterface::class,
            StoreEloquentRepository::class
        );

        $this->app->singleton(
            WalletRepositoryInterface::class,
            WalletEloquentRepository::class
        );

        $this->app->singleton(
            UserConfirmRepositoryInterface::class,
            UserConfirmEloquentRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
