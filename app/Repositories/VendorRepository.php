<?php

namespace App\Repositories;

use App\Models\Vendor;
use App\Repositories\Contracts\VendorRepositoryInterface;
use Illuminate\Support\Collection;

class VendorRepository extends BaseRepository implements VendorRepositoryInterface
{
    /**
     * @return Collection
     */
    public function sortByDelayOrders(): Collection
    {
        $vendors = Vendor::with(['orders' => fn($query) => $query->currentWeek()])->get();
        $vendors = $vendors->sortByDesc(fn($vendor) => $vendor->orders->sum('delay_time'));
        $vendors->map(fn($vendor) => $vendor->delay_time = $vendor->orders->sum('delay_time'));
        return $vendors;
    }
}