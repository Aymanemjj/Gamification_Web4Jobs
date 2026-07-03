<?php

namespace App\Models\Events;

use App\Models\EventType;
use App\Models\User;
use App\Models\MetricKey;
use App\Models\Platform;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BasicEvent extends Model
{
    protected $table = 'events';
    public $timestamps = false;
    
    protected $fillable = [
        'happened_at',
        'event_type_id',
        'dedupe_key',
        'platform_id',
        'user_id',
        'metric_key_id',
    ];

    protected $casts = [
        'happened_at' => 'datetime',
    ];

    /** @return BelongsTo<Platform, BasicEvent> */
    public function platform(): BelongsTo
    {
        return $this->belongsTo(Platform::class);
    }

    /** @return BelongsTo<MetricKey, BasicEvent> */
    public function metricKey(): BelongsTo
    {
        return $this->belongsTo(MetricKey::class);
    }

    /** @return BelongsTo<EventType, BasicEvent> */
    public function eventType(): BelongsTo
    {
        return $this->belongsTo(EventType::class);
    }

    /** @return BelongsTo<User, BasicEvent> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}