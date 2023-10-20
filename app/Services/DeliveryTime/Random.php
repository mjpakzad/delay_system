<?php

namespace App\Services\DeliveryTime;

class Random implements DeliveryTimeInterface
{

    public function getTime(): int
    {
        return rand(1, 300);
    }
}