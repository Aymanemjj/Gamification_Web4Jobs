<?php

namespace App\Models;

use App\Models\Role;
use App\Models\ManualInterventionHistory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Mod extends Model
{
    protected $fillable = ["firstname", "lastname", "age", "email", "password"];

    /** @return BelongsTo<Role, Mod> */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /** @return HasMany<ManualInterventionHistory, Mod> */
    public function manualInterventions(): HasMany
    {
        return $this->hasMany(ManualInterventionHistory::class);
    }
}
