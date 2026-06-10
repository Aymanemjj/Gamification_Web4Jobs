<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MetricKey extends Model
{
    protected $fillable = ["name", "rules"];

    /** @return HasMany<Event, EventType> */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
