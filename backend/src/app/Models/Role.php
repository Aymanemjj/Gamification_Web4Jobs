<?php

namespace App\Models;

use App\Models\Mod;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ["name", "permissions"];

    /** @return HasMany<Mod, Role> */
    public function mods(): HasMany
    {
        return $this->hasMany(Mod::class);
    }
}
