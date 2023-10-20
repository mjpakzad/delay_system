<?php

namespace Tests\Unit;

use App\Models\Courier;
use App\Models\Order;
use App\Models\Trip;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class TripTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function trips_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('trips', [
            'id', 'order_id', 'courier_id', 'status', 'created_at', 'updated_at',
        ]), 1);
    }

    /** @test */
    public function it_belongs_to_a_order()
    {
        $order1 = Order::factory()->create();
        $order2 = Order::factory()->create();
        $trip1 = Trip::factory()->create(['order_id' => $order1->id]);
        $trip2 = Trip::factory()->create(['order_id' => $order2->id]);

        $this->assertInstanceOf(Order::class, $trip1->order);
        $this->assertEquals($order1->id, $trip1->order->id);
        $this->assertNotEquals($order2->id, $trip1->order->id);

        $this->assertInstanceOf(Order::class, $trip2->order);
        $this->assertEquals($order2->id, $trip2->order->id);
        $this->assertNotEquals($order1->id, $trip2->order->id);
    }

    /** @test */
    public function it_belongs_to_a_courier()
    {
        $courier1 = Courier::factory()->create();
        $courier2 = Courier::factory()->create();
        $trip1 = Trip::factory()->create(['courier_id' => $courier1->id]);
        $trip2 = Trip::factory()->create(['courier_id' => $courier2->id]);

        $this->assertInstanceOf(Courier::class, $trip1->courier);
        $this->assertEquals($courier1->id, $trip1->courier->id);
        $this->assertNotEquals($courier2->id, $trip1->courier->id);

        $this->assertInstanceOf(Courier::class, $trip2->courier);
        $this->assertEquals($courier2->id, $trip2->courier->id);
        $this->assertNotEquals($courier1->id, $trip2->courier->id);
    }
}
