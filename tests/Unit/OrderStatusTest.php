<?php

namespace Tests\Unit;

use App\Enums\OrderStatus;
use Tests\TestCase;

class OrderStatusTest extends TestCase
{
    /** @test */
    public function delay_status__has_expected_statuses(): void
    {
        $statuses = [
            'PAYMENT_PENDING' => 10,
            'PAID' => 20,
            'COLLECTING' => 30,
            'SENT' => 40,
            'HANDED_OVER_TO_COURIER' => 60,
            'DELIVERED' => 70,
            'PAYMENT_FAILED' => 80,
            'FAILED' => 90,
            'CANCELED' => 100,
        ];
        $this->assertEquals($statuses, OrderStatus::options());
    }
}
