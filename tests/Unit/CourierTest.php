<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class CourierTest extends TestCase
{
    /** @test */
    public function couriers_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('couriers', [
            'id', 'first_name', 'last_name', 'email', 'email_verified_at', 'password', 'remember_token', 'mobile', 'created_at', 'updated_at',
        ]), 1);
    }
}
