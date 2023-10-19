<?php

namespace Database\Factories;

use App\Models\Courier;
use App\Models\DelayReport;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DelayReport>
 */
class DelayReportFactory extends Factory
{
    protected $model = DelayReport::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'courier_id' => Courier::factory()->create()->id,
        ];
    }
}
