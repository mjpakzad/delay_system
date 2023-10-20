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
            'HANDED_OVER_TO_COURIER' => 50,
            'DELIVERED' => 60,
            'PAYMENT_FAILED' => 70,
            'FAILED' => 80,
            'CANCELED' => 90,
        ];
        $this->assertEquals($statuses, OrderStatus::options());
    }
}
