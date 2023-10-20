<?php

namespace App\Models\Traits\Scopes;

use Carbon\Carbon;

trait DateTrait
{
    public function scopeCurrentWeek($query)
    {
        $date = Carbon::today()->subDays(7);
        return $query->where('created_at', '>=', $date);
    }
}