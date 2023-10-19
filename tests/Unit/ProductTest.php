<?php

namespace Tests\Unit;

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
}
