<?php

namespace App\Models;

use App\Models\Mod;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ["name", "permissions"];


    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
