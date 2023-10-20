<?php

namespace App\Repositories\Contracts;

use App\Models\Agent;
use App\Models\Order;

interface OrderRepositoryInterface
{
    public function hasDelay(Order $order): bool;

    public function hasNotDelay(Order $order): bool;

    public function isOnTrip(Order $order): bool;

    public function increaseDeliveryTime(Order $order, int $delivery_time): bool;

    public function processed(Order $order): bool;

    public function processing(Order $order): bool;

    public function hasOrder(Agent $agent): bool;

    public function IsOrderToAssign(): bool;

    public function assignOrder(Agent $agent): Order;
}