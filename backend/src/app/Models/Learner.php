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
use Laravel\Sanctum\HasApiTokens;

class Learner extends Model
{
    use HasApiTokens;
    
    protected $fillable = [
        "firstname",
        "lastname",
        "age",
        "email",
        "password",
        "xp",
        "league_id",
        "group_id",
        "center_id",
    ];

    /** @return BelongsTo<League, Learner> */
    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class);
    }

    /** @return BelongsTo<Group, Learner> */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    /** @return BelongsTo<Center, Learner> */
    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }

    /** @return HasMany<ScoreTransaction, Learner> */
    public function scoreTransactions(): HasMany
    {
        return $this->hasMany(ScoreTransaction::class);
    }

    /** @return HasMany<AttendanceRecord, Learner> */
    public function attendanceRecords(): HasMany
    {
        return $this->hasMany(AttendanceRecord::class);
    }

    /** @return BelongsToMany<Badge, Learner> */
    public function badges(): BelongsToMany
    {
        return $this->belongsToMany(Badge::class, "badge_learner");
    }

    /** @return BelongsToMany<Platform, Learner> */
    public function platforms(): BelongsToMany
    {
        return $this->belongsToMany(
            Platform::class,
            "learner_platform_accounts",
        )->withPivot("external_learner_id");
    }
}
