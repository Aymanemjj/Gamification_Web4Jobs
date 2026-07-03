<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class League extends Model
{
    protected $fillable = ["title", "color", "min_xp"];

    /** @return HasMany<User, League> */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
