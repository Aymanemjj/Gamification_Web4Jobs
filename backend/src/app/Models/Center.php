<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Center extends Model
{
    protected $fillable = ["name", "location", "learner_count"];

    /** @return HasMany<Learner, Center> */
    public function learners(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /** @return HasMany<AttendanceRecord, Center> */
    public function attendanceRecords(): HasMany
    {
        return $this->hasMany(AttendanceRecord::class);
    }
}
