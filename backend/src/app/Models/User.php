<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Badge;
use App\Models\Platform;
use App\Models\League;
use App\Models\Group;
use App\Models\Center;
use App\Models\ScoreTransaction;
use App\Models\AttendanceRecord;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasApiTokens;
    
    protected $fillable = [
        "firstname",
        "lastname",
        "email",
        "password",
        "role_id",
        "active",
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
    public function isAdmin(): bool
    {
        return $this->role_id === Role::where("name", "super_admin")->first()->id;
    }
    
    public function stats(): HasOne
    {
        return $this->hasOne(UserStats::class);
    }
    public function manualInterventions(): HasMany
    {
        return $this->hasMany(ManualInterventionHistory::class);
    }
    /** @return HasMany<ScoreTransaction, User> */
    public function scoreTransactions(): HasMany
    {
        return $this->hasMany(ScoreTransaction::class);
    }

    /** @return HasMany<AttendanceRecord, User> */
    public function attendanceRecords(): HasMany
    {
        return $this->hasMany(AttendanceRecord::class);
    }

    /** @return BelongsToMany<Badge, User> */
    public function badges(): BelongsToMany
    {
        return $this->belongsToMany(Badge::class, "badge_learner");
    }

    /** @return BelongsToMany<Platform, User> */
    public function platforms(): BelongsToMany
    {
        return $this->belongsToMany(
            Platform::class,
            "user_platform_accounts",
        )->withPivot("external_learner_id");
    }
}
