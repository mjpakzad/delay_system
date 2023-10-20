<?php

namespace Tests\Unit;

use App\Models\Courier;
use App\Models\DelayReport;
use App\Models\Trip;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CourierTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function couriers_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('couriers', [
            'id', 'first_name', 'last_name', 'email', 'email_verified_at', 'password', 'remember_token', 'mobile', 'created_at', 'updated_at',
        ]), 1);
    }

    /** @test */
    public function it_has_many_delay_reports()
    {
        $courier1 = Courier::factory()->create();
        $courier2 = Courier::factory()->create();
        $delayReport1 = DelayReport::factory()->create(['courier_id' => $courier1->id]);
        $delayReport2 = DelayReport::factory()->create(['courier_id' => $courier1->id]);
        $delayReport3 = DelayReport::factory()->create(['courier_id' => $courier2->id]);

        $courier1DelayReports = $courier1->delayReports;
        $courier2DelayReports = $courier2->delayReports;

        $this->assertInstanceOf(DelayReport::class, $courier1DelayReports->first());
        $this->assertCount(2, $courier1DelayReports);
        $this->assertTrue($courier1DelayReports->contains($delayReport1));
        $this->assertTrue($courier1DelayReports->contains($delayReport2));
        $this->assertTrue($courier2DelayReports->contains($delayReport3));

        $this->assertInstanceOf(DelayReport::class, $courier2DelayReports->first());
        $this->assertCount(1, $courier2DelayReports);
        $this->assertTrue($courier2DelayReports->contains($delayReport3));
    }

    /** @test */
    public function it_has_many_trips()
    {
        $courier1 = Courier::factory()->create();
        $courier2 = Courier::factory()->create();
        $trip1 = Trip::factory()->create(['courier_id' => $courier1->id]);
        $trip2 = Trip::factory()->create(['courier_id' => $courier1->id]);
        $trip3 = Trip::factory()->create(['courier_id' => $courier2->id]);

        $courier1Trips = $courier1->trips;
        $courier2Trips = $courier2->trips;

        $this->assertInstanceOf(Trip::class, $courier1Trips->first());
        $this->assertCount(2, $courier1Trips);
        $this->assertTrue($courier1Trips->contains($trip1));
        $this->assertTrue($courier1Trips->contains($trip2));
        $this->assertTrue($courier2Trips->contains($trip3));

        $this->assertInstanceOf(Trip::class, $courier2Trips->first());
        $this->assertCount(1, $courier2Trips);
        $this->assertTrue($courier2Trips->contains($trip3));
    }
}
