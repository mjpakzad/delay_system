<?php

namespace Tests\Unit;

use App\Models\Image;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /** @test */
    public function products_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('products', [
            'id', 'vendor_id', 'heading', 'slug', 'content', 'stock', 'image_id', 'price', 'status', 'title', 'description', 'created_at', 'updated_at',
        ]), 1);
    }

    /** @test */
    public function it_uses_the_correct_route_key_name()
    {
        $product = new Product();
        $this->assertEquals('slug', $product->getRouteKeyName());
    }

    /** @test */
    public function it_belongs_to_a_vendor()
    {
        $vendor1 = Vendor::factory()->create();
        $vendor2 = Vendor::factory()->create();
        $product1 = Product::factory()->create(['vendor_id' => $vendor1->id]);
        $product2 = Product::factory()->create(['vendor_id' => $vendor2->id]);

        $this->assertInstanceOf(Vendor::class, $product1->vendor);
        $this->assertEquals($vendor1->id, $product1->vendor->id);
        $this->assertNotEquals($vendor2->id, $product1->vendor->id);

        $this->assertInstanceOf(Vendor::class, $product2->vendor);
        $this->assertEquals($vendor2->id, $product2->vendor->id);
        $this->assertNotEquals($vendor1->id, $product2->vendor->id);
    }

    /** @test */
    public function it_belongs_to_a_image()
    {
        $image1 = Image::factory()->create();
        $image2 = Image::factory()->create();
        $product1 = Product::factory()->create(['image_id' => $image1->id]);
        $product2 = Product::factory()->create(['image_id' => $image2->id]);

        $this->assertInstanceOf(Image::class, $product1->image);
        $this->assertEquals($image1->id, $product1->image->id);
        $this->assertNotEquals($image2->id, $product1->image->id);

        $this->assertInstanceOf(Image::class, $product2->image);
        $this->assertEquals($image2->id, $product2->image->id);
        $this->assertNotEquals($image1->id, $product2->image->id);
    }
}
