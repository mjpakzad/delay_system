<?php

namespace App\Providers;

use App\Services\DeliveryTime\DeliveryTimeInterface;
use App\Services\DeliveryTime\Mock;
use App\Services\DeliveryTime\Random;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DeliveryTimeInterface::class, Mock::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
