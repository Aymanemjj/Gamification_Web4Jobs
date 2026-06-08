<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Mod;

class ManualInterventionHistory extends Model
{
    protected $fillable = ["date", "affected_table", "justification", "action"];

    /** @return BelongsTo<Mod, ManualInterventionHistory> */
    public function mod(): BelongsTo
    {
        return $this->belongsTo(Mod::class);
    }
}
