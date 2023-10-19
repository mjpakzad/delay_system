<?php

namespace Tests\Unit;

use App\Enums\ProductStatus;
use Tests\TestCase;

class ProductStatusTest extends TestCase
{
    /** @test */
    public function delay_status__has_expected_statuses(): void
    {
        $statuses = [
            'DRAFT' => 10,
            'PUBLISHED' => 20,
            'TRASHED' => 30,
        ];
        $this->assertEquals($statuses, ProductStatus::options());
    }
}
