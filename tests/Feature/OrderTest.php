<?php

namespace Tests\Feature;

use App\Models\Agent;
use App\Models\Order;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Orders list showing in the correct structure.
     *
     * @test
     * @return void
     */
    public function it_has_correct_response_structure_when_showing_orders(): void
    {
        $order = Order::factory()->create();
        $response = $this->getJson(route('orders.index'));
        $response->assertJsonStructure([
            'data'  => [
                '*' => [
                    'vendor',
                    'user',
                    'agent',
                    'delivery_time',
                    'status',
                    'total_price',
                    'content',
                    'products' => [
                        '*' => [
                            'vendor_id',
                            'image_id',
                            'slug',
                            'heading',
                            'content',
                            'stock',
                            'price',
                            'status',
                            'title',
                            'description',
                            'quantity',
                        ],
                    ],
                    'created_at',
                    'delivered_at'
                ]
            ],
        ]);
    }

    /**
     * Show all orders in the route after saving in database.
     *
     * @test
     * @return void
     */
    public function it_shows_all_orders(): void
    {
        $order = Order::factory()->create();
        $response = $this->getJson(route('orders.index'));
        $response->assertJsonFragment(['created_at' => $order->created_at]);
    }

    /** @test */
    public function it_not_assigned_with_wrong_agent_email(): void
    {
        $response = $this->patchJson(route('orders.assign-to-me', ['email' => 'jump@google.com']));
        $response->assertStatus(404);
    }

    /** @test */
    public function it_does_not_assign_if_agent_has_another_processing_order(): void
    {
        $agent = Agent::factory()->create();
        $order = Order::factory()->create(['agent_id' => $agent->id]);
        $response = $this->patchJson(route('orders.assign-to-me', ['email' => $agent->email]));
        $response->assertJsonFragment(['message' => 'You have an order that need to process.']);
    }

    /** @test */
    public function it_assign_order_to_agent(): void
    {
        $agent = Agent::factory()->create();
        $order = Order::factory()->create();
        $response = $this->patchJson(route('orders.assign-to-me', ['email' => $agent->email]));
        $response->assertJsonFragment(['message' => 'An order assign to you.']);
    }
}
