<?php

namespace App\Enums\Traits;

trait SwapTrait
{
    /**
     * Exchange key => value to value => key
     *
     * @return int[]|string[]
     */
    public static function flip($status)
    {
        $options = static::options();
        $flippedArray = array_flip(static::options());
        $name = $flippedArray[$status];
        return str_replace('_', ' ', $name);
    }
}