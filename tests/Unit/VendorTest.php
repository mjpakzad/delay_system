<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class VendorTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function vendors_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('vendors', [
            'id', 'name', 'first_name', 'last_name', 'email', 'email_verified_at', 'password', 'remember_token', 'created_at', 'updated_at',
        ]), 1);
    }

    /** @test */
    public function it_has_many_products()
    {
        $vendor1 = Vendor::factory()->create();
        $vendor2 = Vendor::factory()->create();
        $product1 = Product::factory()->create(['vendor_id' => $vendor1->id]);
        $product2 = Product::factory()->create(['vendor_id' => $vendor1->id]);
        $product3 = Product::factory()->create(['vendor_id' => $vendor2->id]);

        $vendor1Products = $vendor1->products;
        $vendor2Products = $vendor2->products;

        $this->assertInstanceOf(Product::class, $vendor1Products->first());
        $this->assertCount(2, $vendor1Products);
        $this->assertTrue($vendor1Products->contains($product1));
        $this->assertTrue($vendor1Products->contains($product2));
        $this->assertFalse($vendor1Products->contains($product3));

        $this->assertInstanceOf(Product::class, $vendor2Products->first());
        $this->assertCount(1, $vendor2Products);
        $this->assertTrue($vendor2Products->contains($product3));
    }

    /** @test */
    public function it_has_many_orders()
    {
        $vendor1 = Vendor::factory()->create();
        $vendor2 = Vendor::factory()->create();
        $order1 = Order::factory()->create(['vendor_id' => $vendor1->id]);
        $order2 = Order::factory()->create(['vendor_id' => $vendor1->id]);
        $order3 = Order::factory()->create(['vendor_id' => $vendor2->id]);

        $vendor1Orders = $vendor1->orders;
        $vendor2Orders = $vendor2->orders;

        $this->assertInstanceOf(Order::class, $vendor1Orders->first());
        $this->assertCount(2, $vendor1Orders);
        $this->assertTrue($vendor1Orders->contains($order1));
        $this->assertTrue($vendor1Orders->contains($order2));
        $this->assertFalse($vendor1Orders->contains($order3));

        $this->assertInstanceOf(Order::class, $vendor2Orders->first());
        $this->assertCount(1, $vendor2Orders);
        $this->assertTrue($vendor2Orders->contains($order3));
    }
}
