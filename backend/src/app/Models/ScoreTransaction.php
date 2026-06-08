<?php

namespace App\Models;

use App\Models\Learner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScoreTransaction extends Model
{
    protected $fillable = ["happened_at", "attributed_points"];

    /** @return BelongsTo<Learner, ScoreTransaction> */
    public function learner(): BelongsTo
    {
        return $this->belongsTo(Learner::class);
    }
}
