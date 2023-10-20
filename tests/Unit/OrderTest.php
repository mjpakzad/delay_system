<?php

namespace Tests\Unit;

use App\Models\Agent;
use App\Models\Order;
use App\Models\Trip;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function orders_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('orders', [
            'id', 'vendor_id', 'user_id', 'agent_id', 'delivery_time', 'content', 'status', 'total_price', 'created_at', 'updated_at',
        ]), 1);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $order1 = Order::factory()->create();
        $order2 = Order::factory()->create();
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $order1->user()->associate($user1);
        $order1->save();

        $order2->user()->associate($user2);
        $order2->save();

        $this->assertInstanceOf(User::class, $order1->user);
        $this->assertEquals($user1->id, $order1->user->id);
        $this->assertNotEquals($user2->id, $order1->user->id);

        $this->assertInstanceOf(User::class, $order2->user);
        $this->assertEquals($user2->id, $order2->user->id);
        $this->assertNotEquals($user1->id, $order2->user->id);
    }

    /** @test */
    public function it_belongs_to_a_vendor()
    {
        $order1 = Order::factory()->create();
        $order2 = Order::factory()->create();
        $vendor1 = Vendor::factory()->create();
        $vendor2 = Vendor::factory()->create();

        $order1->vendor()->associate($vendor1);
        $order1->save();

        $order2->vendor()->associate($vendor2);
        $order2->save();

        $this->assertInstanceOf(Vendor::class, $order1->vendor);
        $this->assertEquals($vendor1->id, $order1->vendor->id);
        $this->assertNotEquals($vendor2->id, $order1->vendor->id);

        $this->assertInstanceOf(Vendor::class, $order2->vendor);
        $this->assertEquals($vendor2->id, $order2->vendor->id);
        $this->assertNotEquals($vendor1->id, $order2->vendor->id);
    }

    /** @test */
    public function it_belongs_to_a_agent()
    {
        $order1 = Order::factory()->create();
        $order2 = Order::factory()->create();
        $agent1 = Agent::factory()->create();
        $agent2 = Agent::factory()->create();

        $order1->agent()->associate($agent1);
        $order1->save();

        $order2->agent()->associate($agent2);
        $order2->save();

        $this->assertInstanceOf(Agent::class, $order1->agent);
        $this->assertEquals($agent1->id, $order1->agent->id);
        $this->assertNotEquals($agent2->id, $order1->agent->id);

        $this->assertInstanceOf(Agent::class, $order2->agent);
        $this->assertEquals($agent2->id, $order2->agent->id);
        $this->assertNotEquals($agent1->id, $order2->agent->id);
    }

    /** @test */
    public function it_has_many_trips()
    {
        $order1 = Order::factory()->create();
        $order2 = Order::factory()->create();
        $trip1 = Trip::factory()->create(['order_id' => $order1->id]);
        $trip2 = Trip::factory()->create(['order_id' => $order1->id]);
        $trip3 = Trip::factory()->create(['order_id' => $order2->id]);

        $order1Trips = $order1->trips;
        $order2Trips = $order2->trips;

        $this->assertInstanceOf(Trip::class, $order1Trips->first());
        $this->assertCount(2, $order1Trips);
        $this->assertTrue($order1Trips->contains($trip1));
        $this->assertTrue($order1Trips->contains($trip2));
        $this->assertFalse($order1Trips->contains($trip3));

        $this->assertInstanceOf(Trip::class, $order2Trips->first());
        $this->assertCount(1, $order2Trips);
        $this->assertTrue($order2Trips->contains($trip3));
    }
}
