<?php

namespace App\Models;

use App\Enums\DelayStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DelayReport extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'user_id',
        'courier_id',
        'status',
    ];

    /**
     * Get the order associated with the delay_report
     *
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the user associated with the delay_report
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the courier associated with the delay_report
     *
     * @return BelongsTo
     */
    public function courier(): BelongsTo
    {
        return $this->belongsTo(Courier::class);
    }

    /**
     * A scope to determine the order status.
     *
     * @param $query
     * @return mixed
     */
    public function scopeProcessed($query)
    {
        return $query->whereIn('status', [DelayStatus::DELIVERED, DelayStatus::FAILED, DelayStatus::INCREASE_DELIVERY_TIME]);
    }

    /**
     * A scope to determine the order status.
     *
     * @param $query
     * @return mixed
     */
    public function scopeProcessing($query)
    {
        return $query->whereNotIn('status', [DelayStatus::DELIVERED, DelayStatus::FAILED, DelayStatus::INCREASE_DELIVERY_TIME]);
    }
}
