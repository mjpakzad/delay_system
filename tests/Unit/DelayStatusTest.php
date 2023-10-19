<?php

namespace Tests\Unit;

use App\Enums\DelayStatus;
use Tests\TestCase;

class DelayStatusTest extends TestCase
{
    /** @test */
    public function delay_status__has_expected_statuses(): void
    {
        $statuses = [
            'DELAY' => 10,
            'CHECKING' => 20,
            'TRACKING' => 30,
            'INCREASE_DELIVERY_TIME' => 40,
            'DELIVERED' => 50,
            'FAILED' => 60,
        ];
        $this->assertEquals($statuses, DelayStatus::options());
    }
}
