<?php

namespace App\Providers;

use App\Repositories\Contracts\DelayReporitoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\VendorRepositoryInterface;
use App\Repositories\DelayRepository;
use App\Repositories\OrderRepository;
use App\Repositories\VendorRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(DelayReporitoryInterface::class, DelayRepository::class);
        $this->app->bind(VendorRepositoryInterface::class, VendorRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
