<?php

namespace Tests\Unit;

use Tests\TestCase;

class AgentTest extends TestCase
{
    /** @test */
    public function agents_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('agents', [
            'id', 'first_name', 'last_name', 'email', 'email_verified_at', 'password', 'remember_token', 'created_at', 'updated_at',
        ]), 1);
    }
}
