<?php

namespace Tests\Feature;

use App\Enums\DelayStatus;
use App\Enums\TripStatus;
use App\Models\DelayReport;
use App\Models\Order;
use App\Models\Trip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DelayTest extends TestCase
{
    /** @test */
    public function it_stop_reporting_delay_when_not_have_delay(): void
    {
        $order = Order::factory()->create();
        $response = $this->postJson(route('orders.delays.report', $order->id));
        $response->assertJsonFragment(['message' => 'You can\'t report any delay until finishing delivery time.']);
    }

    /** @test */
    public function it_needs_to_process_another_report_first(): void
    {
        $order = Order::factory()->create(['created_at' => now()->subMinutes(20), 'delivery_time' => 5]);
        $delay = DelayReport::factory()->create(['order_id' => $order->id, 'status' => DelayStatus::DELAY]);
        $response = $this->postJson(route('orders.delays.report', $order->id));
        $response->assertJsonFragment(['message' => 'The order is under processing.']);
    }

    /** @test */
    public function it_increase_delivery_time_when_has_trip(): void
    {
        $order = Order::factory()->create(['created_at' => now()->subMinutes(20), 'delivery_time' => 5]);
        $trip = Trip::factory()->create(['order_id' => $order->id, 'status' => TripStatus::PICKED]);
        $delivery_time = $order->delivery_time;
        $response = $this->postJson(route('orders.delays.report', $order->id));
        $order = Order::find($order->id);
        $this->assertTrue($delivery_time < $order->delivery_time);
    }

    /** @test */
    public function it_save_report_if_has_delay(): void
    {
        $order = Order::factory()->create(['created_at' => now()->subMinutes(20), 'delivery_time' => 5]);
        $response = $this->postJson(route('orders.delays.report', $order->id));
        $this->assertDatabaseHas('delay_reports', ['order_id' => $order->id, 'status' => DelayStatus::DELAY]);
    }
}
