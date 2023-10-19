<?php

namespace Database\Factories;

use App\Enums\TripStatus;
use App\Models\Courier;
use App\Models\Order;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Trip>
 */
class TripFactory extends Factory
{
    protected $model = Trip::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'courier_id' => Courier::factory(),
            'status' => fake()->randomElement(TripStatus::values()),
        ];
    }
}
