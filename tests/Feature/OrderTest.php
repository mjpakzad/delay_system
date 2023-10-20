<?php

namespace Tests\Feature;

use App\Models\Order;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Cities list showing in the correct structure.
     *
     * @test
     * @return void
     */
    public function it_has_correct_response_structure_when_showing_cities()
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
    public function it_shows_all_orders()
    {
        $order = Order::factory()->create();
        $response = $this->getJson(route('orders.index'));
        $response->assertJsonFragment(['created_at' => $order->created_at]);
    }
}
