<?php

namespace App\Models;

use App\Models\User;
use App\Models\Events\BasicEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Platform extends Model
{
    protected $fillable = ["name", "weight", "key"];

    /** @return HasMany<Event, Platform> */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    /** @return BelongsToMany<User, Platform> */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            "user_platform_accounts",
        )->withPivot("external_learner_id");
    }
}
