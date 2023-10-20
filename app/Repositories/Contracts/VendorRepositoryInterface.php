<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface VendorRepositoryInterface
{
    public function sortByDelayOrders(): Collection;
}