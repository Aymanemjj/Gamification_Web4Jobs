<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        "type",
        "platform_id",
    ];

    public function platform(): BelongsTo
    {
        return $this->belongsTo(Platform::class);
    }
}