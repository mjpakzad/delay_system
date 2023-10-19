<?php

namespace Tests\Unit;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ImageTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function images_table_has_expected_columns(): void
    {
        $this->assertTrue(Schema::hasColumns('images', [
            'id', 'path', 'created_at', 'updated_at'
        ]), 1);
    }

    /** @test */
    public function it_has_many_products()
    {
        $image1 = Image::factory()->create();
        $image2 = Image::factory()->create();
        $product1 = Product::factory()->create(['image_id' => $image1->id]);
        $product2 = Product::factory()->create(['image_id' => $image1->id]);
        $product3 = Product::factory()->create(['image_id' => $image2->id]);

        $image1Products = $image1->products;
        $image2Products = $image2->products;

        $this->assertInstanceOf(Product::class, $image1Products->first());
        $this->assertCount(2, $image1Products);
        $this->assertTrue($image1Products->contains($product1));
        $this->assertTrue($image1Products->contains($product2));
        $this->assertFalse($image1Products->contains($product3));

        $this->assertInstanceOf(Product::class, $image2Products->first());
        $this->assertCount(1, $image2Products);
        $this->assertTrue($image2Products->contains($product3));
    }
}
