<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Center;

class AttendanceRecord extends Model
{
    protected $fillable = ["attended", "center_id", "user_id"];

    /** @return BelongsTo<Learner, AttendanceRecord> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** @return BelongsTo<Center, AttendanceRecord> */
    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }
}
