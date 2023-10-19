<?php

namespace Tests\Unit;

use App\Models\Courier;
use App\Models\DelayReport;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class DelayReportTest extends TestCase
{
    /** @test */
    public function delay_reports_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('delay_reports', [
            'id', 'order_id', 'user_id', 'courier_id', 'created_at', 'updated_at',
        ]), 1);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $delayReport1 = DelayReport::factory()->create(['user_id' => $user1->id]);
        $delayReport2 = DelayReport::factory()->create(['user_id' => $user2->id]);

        $this->assertInstanceOf(User::class, $delayReport1->user);
        $this->assertEquals($user1->id, $delayReport1->user->id);
        $this->assertNotEquals($user2->id, $delayReport1->user->id);

        $this->assertInstanceOf(User::class, $delayReport2->user);
        $this->assertEquals($user2->id, $delayReport2->user->id);
        $this->assertNotEquals($user1->id, $delayReport2->user->id);
    }

    /** @test */
    public function it_belongs_to_a_courier()
    {
        $courier1 = Courier::factory()->create();
        $courier2 = Courier::factory()->create();
        $delayReport1 = DelayReport::factory()->create(['courier_id' => $courier1->id]);
        $delayReport2 = DelayReport::factory()->create(['courier_id' => $courier2->id]);

        $this->assertInstanceOf(Courier::class, $delayReport1->courier);
        $this->assertEquals($courier1->id, $delayReport1->courier->id);
        $this->assertNotEquals($courier2->id, $delayReport1->courier->id);

        $this->assertInstanceOf(Courier::class, $delayReport2->courier);
        $this->assertEquals($courier2->id, $delayReport2->courier->id);
        $this->assertNotEquals($courier1->id, $delayReport2->courier->id);
    }

    /** @test */
    public function it_belongs_to_a_order()
    {
        $order1 = Order::factory()->create();
        $order2 = Order::factory()->create();
        $delayReport1 = DelayReport::factory()->create(['order_id' => $order1->id]);
        $delayReport2 = DelayReport::factory()->create(['order_id' => $order2->id]);

        $this->assertInstanceOf(Order::class, $delayReport1->order);
        $this->assertEquals($order1->id, $delayReport1->order->id);
        $this->assertNotEquals($order2->id, $delayReport1->order->id);

        $this->assertInstanceOf(Order::class, $delayReport2->order);
        $this->assertEquals($order2->id, $delayReport2->order->id);
        $this->assertNotEquals($order1->id, $delayReport2->order->id);
    }
}
