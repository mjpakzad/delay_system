<?php

namespace App\Providers;

use App\Repositories\Contracts\DelayReporitoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\DelayRepository;
use App\Repositories\OrderRepository;
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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
