<?php

namespace App\Services\DeliveryTime;

use Illuminate\Support\Facades\Http;

class Mock implements DeliveryTimeInterface
{

    public function getTime(): int
    {
        try {
            $response = Http::asJson()->get(config('snappfood.mock_io.endpoint'));
            return json_decode($response->body())->delivery_time;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}