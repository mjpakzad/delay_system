<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum DelayStatus: int
{
    use InvokableCases;
    use Values;
    use Options;

    /**
     * The order has at least on delay report.
     */
    case DELAY = 10;

    /**
     * The agent is checking whether there is really a delay.
     */
    case CHECKING = 20;

    /**
     * The agent is tracking the status of the order.
     */
    case TRACKING = 30;

    /**
     * The delivery time must be recalculated.
     */
    case INCREASE_DELIVERY_TIME = 40;

    /**
     * The order delivered successfully.
     */
    case DELIVERED = 50;

    /**
     * The order failed.
     */
    case FAILED = 60;
}
