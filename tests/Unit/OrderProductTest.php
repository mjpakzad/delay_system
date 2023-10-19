<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class OrderProductTest extends TestCase
{
    /** @test */
    public function order_product_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('order_product', [
            'order_id', 'product_id', 'quantity', 'price',
        ]), 1);
    }
}
