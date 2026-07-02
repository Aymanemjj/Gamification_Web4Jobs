<?php

namespace App\Services;

use App\Models\LeaderboardSnapshot;
use App\Models\User;

class LeaderBoardService
{
    public function makeSnapshot(): void
    {
        $leaderboard = User::with('stats')
            ->get()
            ->sortByDesc(fn ($user) => $user->stats->xp)
            ->map(fn ($user) => [
                'user' => [
                    'id'         => $user->id,
                    'first_name' => $user->first_name,
                    'last_name'  => $user->last_name,
                    'email'      => $user->email,
                    'xp'         => $user->stats->xp,
                ],
            ]);
    
        LeaderboardSnapshot::create([
            'leaderboard' => $leaderboard,
        ]);
    }
}
