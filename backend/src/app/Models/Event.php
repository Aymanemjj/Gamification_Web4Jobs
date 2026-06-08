<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    protected $fillable = [
        "happened_at",
        "dedube_key",
        "platform_id",
        "event_type_id",
    ];

    /** @return BelongsTo<Platform, Event> */
    public function platform(): BelongsTo
    {
        return $this->belongsTo(Platform::class);
    }

    /** @return BelongsTo<EventType, Event> */
    public function eventType(): BelongsTo
    {
        return $this->belongsTo(EventType::class);
    }
}
