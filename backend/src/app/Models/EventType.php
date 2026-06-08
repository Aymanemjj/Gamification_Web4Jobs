<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EventType extends Model
{
    protected $fillable = ["name", "point", "limit_type", "limit_value"];

    /** @return HasMany<Event, EventType> */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
