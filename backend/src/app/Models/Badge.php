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

    /** @return BelongsToMany<Learner, Badge> */
    public function winners(): BelongsToMany
    {
        return $this->belongsToMany(Learner::class, "badge_learner");
    }
}
