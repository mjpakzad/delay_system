<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VendorTest extends TestCase
{
    /** @test */
    public function test_example(): void
    {
        $response = $this->getJson(route('vendors.index'));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data'  => [
                '*' => [
                    'name',
                    'delay duration',
                ]
            ],
        ]);
    }
}
