<?php

namespace App\Http\Resources;

use App\Enums\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'vendor' => $this->vendor->name,
            'user' => $this->user->name,
            'agent' => $this->agent?->name,
            'delivery_time' => $this->delivery_time . ' minutes',
            'status' => OrderStatus::flip($this->status),
            'total_price' => '$' . $this->total_price,
            'content' => $this->content,
            'products' => $this->whenLoaded('products', new ProductCollection($this->products)),
            'created_at' => $this->created_at,
            'delivered_at' => $this->delivered_at,
        ];
    }
}
