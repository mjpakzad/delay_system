<?php

namespace App\Observers;

use App\Enums\DelayStatus;
use App\Models\DelayReport;

class DelayReportObserver
{
    /**
     * Handle the DelayReport "updated" event.
     */
    public function updated(DelayReport $delayReport): void
    {
        if(in_array($delayReport->status , [DelayStatus::INCREASE_DELIVERY_TIME->value, DelayStatus::DELIVERED->value, DelayStatus::FAILED->value])) {
            $delayReport->order()->update(['agent_id' => null]);
        }
    }
}
