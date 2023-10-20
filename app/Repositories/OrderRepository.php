<?php

namespace App\Repositories;

use App\Enums\TripStatus;
use App\Models\Agent;
use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    /**
     * @return string
     */
    public function getModelName(): string
    {
        return Order::class;
    }

    /**
     * Determine if order has delay.
     *
     * @param Order $order
     * @return bool
     */
    public function hasDelay(Order $order): bool
    {
        return !$order->delivered_at->isFuture();
    }

    /**
     * Determine if order has not delayed.
     *
     * @param Order $order
     * @return bool
     */
    public function hasNotDelay(Order $order): bool
    {
        return $order->delivered_at->isFuture();
    }

    /**
     * Determine if the order has trip and trip has on of the following statuses: ASSIGNED, AT_VENDOR, PICKED.
     *
     * @param Order $order
     * @return bool
     */
    public function isOnTrip(Order $order): bool
    {
        $hasTrip = $order->trips()->exists();
        if($hasTrip) {
            $order->load('trips');
            $trip = $order->trips->first();
            if(in_array($trip->status, [TripStatus::ASSIGNED->value, TripStatus::AT_VENDOR->value, TripStatus::PICKED->value])) {
                return true;
            }
        }
        return false;
    }

    /**
     * Add delivery_time to the current delivery_time.
     *
     * @param Order $order
     * @param int $delivery_time
     * @return bool
     */
    public function increaseDeliveryTime(Order $order, int $delivery_time): bool
    {
        return $order->increment('delivery_time', $delivery_time);
    }

    /**
     * Add delivery_time to the current delay_time.
     *
     * @param Order $order
     * @param int $delivery_time
     * @return bool
     */
    public function increaseDelayTime(Order $order, int $delivery_time): bool
    {
        return $order->increment('delay_time', $delivery_time);
    }

    /**
     * @param Order $order
     * @return bool
     */
    public function processed(Order $order): bool
    {
        return $order->delayReports()->processed()->exists();
    }

    /**
     * @param Order $order
     * @return bool
     */
    public function processing(Order $order): bool
    {
        return $order->delayReports()->processing()->exists();
    }

    /**
     * Determine if an agent has order(s).
     *
     * @param Agent $agent
     * @return bool
     */
    public function hasOrder(Agent $agent): bool
    {
        return Order::query()->where('agent_id', $agent->id)->exists();
    }

    /**
     * Determine if there is an order to assign.
     *
     * @return bool
     */
    public function IsOrderToAssign(): bool
    {
        return Order::query()->unassigned()->processing()->exists();
    }

    /**
     * Assign first unassigned order to the specific agent.
     *
     * @param Agent $agent
     * @return Order
     */
    public function assignOrder(Agent $agent): Order
    {
        $order = Order::query()->oldest()->unassigned()->processing()->first();
        $order->update(['agent_id' => $agent->id]);
        return $order;
    }
}