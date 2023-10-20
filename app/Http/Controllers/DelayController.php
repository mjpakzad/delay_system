<?php

namespace App\Http\Controllers;

use App\Enums\DelayStatus;
use App\Models\Order;
use App\Repositories\Contracts\DelayReporitoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Services\DeliveryTime\DeliveryTimeInterface;
use Illuminate\Http\Request;

class DelayController extends Controller
{
    public function __construct(private OrderRepositoryInterface $orderRepository)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function report(Order $order, Request $request)
    {
        if($this->orderRepository->hasNotDelay($order)) {
            return response()->json([
                'message' => 'You can\'t report any delay until finishing delivery time.'
            ]);
        }

        if($this->orderRepository->processing($order)) {
            return response()->json([
                'message' => 'The order is under processing.'
            ]);
        }

        $delayRepository = resolve(DelayReporitoryInterface::class);

        if($this->orderRepository->isOnTrip($order)) {
            $delivery_time = resolve(DeliveryTimeInterface::class)->getTime();
            $this->orderRepository->increaseDeliveryTime($order, $delivery_time);
            $delayRepository->create(['order_id' => $order->id, 'user_id' => $order->user_id, 'courier_id' => $order->trips()->first()?->courier_id, 'status' => DelayStatus::DELAY]);
            return response()->json([
                'message' => 'Your report submitted and the your order will delivered until: ' . $order->delivered_at,
            ]);
        }

        $delayRepository->create(['order_id' => $order->id, 'user_id' => $order->user_id, 'status' => DelayStatus::DELAY]);

        return response()->json([
            'message' => 'Your report submitted successfully.',
        ]);
    }
}
