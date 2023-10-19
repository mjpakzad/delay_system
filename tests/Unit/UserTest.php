<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function users_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('users', [
            'id', 'first_name', 'last_name', 'email', 'email_verified_at', 'password', 'remember_token', 'created_at', 'updated_at',
        ]), 1);
    }

    /** @test */
    public function it_has_many_orders()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $order1 = Order::factory()->create(['user_id' => $user1->id]);
        $order2 = Order::factory()->create(['user_id' => $user1->id]);
        $order3 = Order::factory()->create(['user_id' => $user2->id]);

        $user1Orders = $user1->orders;
        $user2Orders = $user2->orders;

        $this->assertInstanceOf(Order::class, $user1Orders->first());
        $this->assertCount(2, $user1Orders);
        $this->assertTrue($user1Orders->contains($order1));
        $this->assertTrue($user1Orders->contains($order2));
        $this->assertFalse($user1Orders->contains($order3));

        $this->assertInstanceOf(Order::class, $user2Orders->first());
        $this->assertCount(1, $user2Orders);
        $this->assertTrue($user2Orders->contains($order3));
    }
}
