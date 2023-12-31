<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Models\Traits\Scopes\DateTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    use DateTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'vendor_id',
        'user_id',
        'agent_id',
        'delivery_time',
        'delay_time',
        'content',
        'status',
        'total_price',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'delivery_time' => 'integer',
        'delay_time' => 'integer',
        'status' => 'integer',
        'price' => 'integer',
    ];

    /**
     * Get the order's delivered_at.
     */
    protected function deliveredAt(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->created_at->addMinutes($this->delivery_time),
        );
    }

    /**
     * Get delay_reports associated with the order.
     *
     * @return HasMany
     */
    public function delayReports(): HasMany
    {
        return $this->hasMany(DelayReport::class);
    }

    /**
     * Get the vendor associated with the order.
     *
     * @return BelongsTo
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * Get the user associated with the user.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the agent associated with the user.
     *
     * @return BelongsTo
     */
    public function agent(): BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }

    /**
     * Get products associated with orders.
     *
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot(['quantity', 'price']);
    }

    /**
     * Get trips associated with the order.
     *
     * @return HasMany
     */
    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }

    /**
     * Scope to determine orders that doesn't have agent
     * @param $query
     * @return mixed
     */
    public function scopeUnassigned($query)
    {
        return $query->whereNull('agent_id');
    }

    /**
     * Scope to select orders that user still waited for them.
     * @param $query
     * @return mixed
     */
    public function scopeProcessing($query)
    {
        return $query->whereIn('status', [
            OrderStatus::PAYMENT_PENDING->value,
            OrderStatus::PAID->value,
            OrderStatus::COLLECTING->value,
            OrderStatus::SENT->value,
            OrderStatus::HANDED_OVER_TO_COURIER,
        ]);
    }
}
