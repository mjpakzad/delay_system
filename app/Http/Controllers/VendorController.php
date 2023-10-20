<?php

namespace App\Http\Controllers;

use App\Http\Resources\VendorCollection;
use App\Models\Vendor;
use App\Repositories\Contracts\VendorRepositoryInterface;

class VendorController extends Controller
{
    public function __construct(private VendorRepositoryInterface $vendorRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = $this->vendorRepository->sortByDelayOrders();
        return VendorCollection::make($vendors);
    }
}
