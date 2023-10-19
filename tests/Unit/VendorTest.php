<?php

namespace Tests\Unit;

use Tests\TestCase;

class VendorTest extends TestCase
{
    /** @test */
    public function vendors_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('vendors', [
            'id', 'name', 'first_name', 'last_name', 'created_at', 'updated_at',
        ]), 1);
    }
}
