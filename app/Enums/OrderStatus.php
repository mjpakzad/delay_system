<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum OrderStatus: int
{
    use InvokableCases;
    use Values;
    use Options;

    /**
     * The order is awaiting payment.
     */
    case PAYMENT_PENDING = 10;

    /**
     * The order has been paid for.
     */
    case PAID = 20;

    /**
     * Products are being collected for the order.
     */
    case COLLECTING = 30;

    /**
     * The order is in the process of being sent.
     */
    case SENT = 40;

    /**
     * The order has been handed over to the courier for delivery.
     */
    case HANDED_OVER_TO_COURIER = 60;

    /**
     * The order has been delivered successfully.
     */
    case DELIVERED = 70;

    /**
     * Payment for the order has failed.
     */
    case PAYMENT_FAILED = 80;

    /**
     * The order failed.
     */
    case FAILED = 90;

    /**
     * The order canceled.
     */
    case CANCELED = 100;
}
