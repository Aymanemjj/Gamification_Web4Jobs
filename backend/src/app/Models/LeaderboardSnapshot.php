<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaderboardSnapshot extends Model
{
    protected $fillable = ["date", "leaderboard"];
}
