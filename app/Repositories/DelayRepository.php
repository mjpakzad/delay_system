<?php

namespace App\Repositories;

use App\Models\DelayReport;
use App\Repositories\Contracts\DelayReporitoryInterface;

class DelayRepository extends BaseRepository implements DelayReporitoryInterface
{
    /**
     * @return string
     */
    public function getModelName(): string
    {
        return DelayReport::class;
    }
}