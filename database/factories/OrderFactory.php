<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Models\Agent;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vendor_id' => Vendor::factory(),
            'user_id' => User::factory(),
            'agent_id' => Agent::factory(),
            'delivery_time' => fake()->numberBetween(1, 180),
            'delay_time' => fake()->numberBetween([1, 150]),
            'content' => fake()->text(),
            'status' => fake()->randomElement(OrderStatus::values()),
            'total_price' => rand(100, 150000),
        ];
    }

    public function configure(): OrderFactory|Factory
    {
        return $this->afterCreating(function (Order $order) {
            $products = [];
            $loopIteration = rand(1, 10);
            for ($i = 0; $i < $loopIteration; $i++) {
                $products[] = [
                    'product_id' => Product::factory()->create()->id,
                    'quantity' => rand(1, 100),
                    'price' => rand(1000, 15000000),
                ];
            }
            $order->products()->attach($products);
        });
    }
}
