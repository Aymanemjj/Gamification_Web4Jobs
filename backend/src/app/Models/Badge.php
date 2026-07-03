<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Badge extends Model
{
    protected $fillable = [
        "name",
        "description",
        "emoji",
        "rarity",
        "type",
        "wining_rules",
    ];

    /** @return BelongsToMany<User, Badge> */
    public function winners(): BelongsToMany
    {
        return $this->belongsToMany(User::class, "badge_learner");
    }
}
