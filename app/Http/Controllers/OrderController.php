<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderCollection;
use App\Models\Agent;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct(private OrderRepositoryInterface $orderRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = $this->orderRepository->list([], ['vendor', 'user', 'agent', 'products']);
        return OrderCollection::make($orders);
    }

    /**
     * Assign an order to me.
     */
    public function assignToMe(Request $request)
    {
        $agent = Agent::where('email', $request->input('email'))->firstOrFail();

        if($this->orderRepository->hasOrder($agent)) {
           return response()->json([
               'message' => 'You have an order that need to process.',
           ]);
        }

        if(!$this->orderRepository->IsOrderToAssign()) {
            return response()->json([
                'message' => 'There is no order with delay.',
            ]);
        }

        $order = $this->orderRepository->assignOrder($agent);

        return response()->json([
            'message' => 'An order assign to you.',
        ]);
    }
}
