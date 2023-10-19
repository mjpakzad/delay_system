<?php

namespace Tests\Unit;

use Tests\TestCase;

class DelayReportTest extends TestCase
{
    /** @test */
    public function delay_reports_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('delay_reports', [
            'id', 'order_id', 'user_id', 'courier_id', 'created_at', 'updated_at',
        ]), 1);
    }
}
