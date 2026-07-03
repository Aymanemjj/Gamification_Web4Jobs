<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScoreTransaction extends Model
{
    protected $fillable = ["happened_at", "attributed_points"];

    /** @return BelongsTo<User, ScoreTransaction> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
