<?php

namespace App\Models;

use App\Models\Role;
use App\Models\ManualInterventionHistory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Mod extends Model
{
    use HasApiTokens;
    
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
