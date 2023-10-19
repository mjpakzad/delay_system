<?php

namespace Tests\Unit;

use App\Enums\TripStatus;
use Tests\TestCase;

class TripStatusTest extends TestCase
{
    /** @test */
    public function delay_status__has_expected_statuses(): void
    {
        $statuses = [
            'ASSIGNED' => 10,
            'AT_VENDOR' => 20,
            'PICKED' => 30,
            'DELIVERED' => 40,
        ];
        $this->assertEquals($statuses, TripStatus::options());
    }
}
