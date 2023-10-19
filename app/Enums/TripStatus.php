<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum TripStatus: int
{
    use InvokableCases;
    use Values;
    use Options;

    /**
     * The trip assigned to a courier.
     */
    case ASSIGNED = 10;

    /**
     * The trip is awaiting the assigned courier at the vendor.
     */
    case AT_VENDOR = 20;

    /**
     * The courier picked the order and is on the way to destination.
     */
    case PICKED = 30;

    /**
     * The order has been delivered successfully.
     */
    case DELIVERED = 40;
}
