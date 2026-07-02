<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaderboardSnapshot extends Model
{
    public $timestamps = false;

    protected $fillable = ['leaderboard', 'created_at'];

    protected $casts = [
        'leaderboard' => 'array',
        'created_at'  => 'datetime',
    ];
}