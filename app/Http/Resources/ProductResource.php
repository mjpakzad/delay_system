<?php

namespace App\Http\Resources;

use App\Enums\ProductStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $product = [
            'vendor_id' => $this->vendor->name,
            'image_id' => $this->image?->path,
            'slug' => $this->slug,
            'heading' => $this->heading,
            'content' => $this->content,
            'stock' => $this->stock,
            'price' => '$' . $this->pivot->price ?? $this->price,
            'status' => ProductStatus::flip($this->status),
            'title' => $this->title,
            'description' => $this->description,
        ];
        if(isset($this->pivot->quantity)) {
            $product['quantity'] = $this->pivot->quantity;
        }
        return $product;
    }
}
