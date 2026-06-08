<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Center;

class AttendanceRecord extends Model
{
    protected $fillable = ["attended", "center_id", "learner_id"];

    /** @return BelongsTo<Learner, AttendanceRecord> */
    public function learner(): BelongsTo
    {
        return $this->belongsTo(Learner::class);
    }

    /** @return BelongsTo<Center, AttendanceRecord> */
    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }
}
