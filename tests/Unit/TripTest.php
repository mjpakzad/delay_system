<?php

namespace Tests\Unit;

use Tests\TestCase;

class TripTest extends TestCase
{
    /** @test */
    public function trips_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('trips', [
            'id', 'order_id', 'courier_id', 'status', 'created_at', 'updated_at',
        ]), 1);
    }
}
