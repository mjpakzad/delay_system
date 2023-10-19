<?php

namespace Database\Factories;

use App\Enums\ProductStatus;
use App\Models\Image;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $discount = rand(0, 1) ? rand(1, 100) : 0;
        $price = rand(1, 150000);
        return [
            'vendor_id' => Vendor::factory(),
            'image_id' => Image::factory(),
            'slug' => fake()->unique()->slug,
            'heading' => fake()->sentence(),
            'content' => fake()->text(),
            'stock' => rand(0, 100),
            'price' => rand(1000, 16000000),
            'status' => fake()->randomElement(ProductStatus::values()),
            'title' => fake()->sentence(),
            'description' => fake()->text(),
        ];
    }
}
