<?php

namespace App\Models\Events;

use App\Models\MetricKey;
use App\Models\Platform;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BasicEvent extends Model
{
    protected $fillable = [
        "happened_at",
        "event_type",
        "dedube_key",
        "platform_id",
        "learner_id",
        "MetricKey_id",
    ];

    /** @return BelongsTo<Platform, BasicEvent> */
    public function platform(): BelongsTo
    {
        return $this->belongsTo(Platform::class);
    }

    /** @return BelongsTo<MetricKey, BasicEvent> */
    public function eventType(): BelongsTo
    {
        return $this->belongsTo(MetricKey::class);
    }
}
