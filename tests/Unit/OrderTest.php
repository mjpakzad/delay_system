<?php

namespace Tests\Unit;

use Tests\TestCase;

class OrderTest extends TestCase
{
    /** @test */
    public function orders_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('orders', [
            'id', 'vendor_id', 'user_id', 'agent_id', 'delivery_time', 'status', 'total_price', 'created_at', 'updated_at',
        ]), 1);
    }
}
