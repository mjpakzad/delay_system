<?php

namespace Tests\Unit;

use App\Models\Agent;
use App\Models\Order;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AgentTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function agents_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('agents', [
            'id', 'first_name', 'last_name', 'email', 'email_verified_at', 'password', 'remember_token', 'created_at', 'updated_at',
        ]), 1);
    }

    /** @test */
    public function it_has_many_orders()
    {
        $agent1 = Agent::factory()->create();
        $agent2 = Agent::factory()->create();
        $order1 = Order::factory()->create(['agent_id' => $agent1->id]);
        $order2 = Order::factory()->create(['agent_id' => $agent1->id]);
        $order3 = Order::factory()->create(['agent_id' => $agent2->id]);

        $agent1Orders = $agent1->orders;
        $agent2Orders = $agent2->orders;

        $this->assertInstanceOf(Order::class, $agent1Orders->first());
        $this->assertCount(2, $agent1Orders);
        $this->assertTrue($agent1Orders->contains($order1));
        $this->assertTrue($agent1Orders->contains($order2));
        $this->assertFalse($agent1Orders->contains($order3));

        $this->assertInstanceOf(Order::class, $agent2Orders->first());
        $this->assertCount(1, $agent2Orders);
        $this->assertTrue($agent2Orders->contains($order3));
    }
}
