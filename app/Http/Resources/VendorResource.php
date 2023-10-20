<?php

namespace App\Http\Resources;

use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'delay duration' => CarbonInterval::seconds($this->delay_time)->cascade()->forHumans(),
        ];
    }
}
