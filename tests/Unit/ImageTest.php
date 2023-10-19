<?php

namespace Tests\Unit;

use Tests\TestCase;

class ImageTest extends TestCase
{
    /** @test */
    public function images_table_has_expected_columns(): void
    {
        $this->assertTrue(Schema::hasColumns('images', [
            'id', 'user_id', 'path', 'created_at', 'updated_at'
        ]), 1);
    }
}
