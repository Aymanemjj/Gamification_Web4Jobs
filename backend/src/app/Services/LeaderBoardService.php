<?php

namespace App\Services;

use App\Models\LeaderboardSnapshot;
use App\Models\User;

class LeaderBoardService
{
    public function makeSnapshot(): void
    {
        $leaderboard = User::where('role_id', 1)
            ->with('stats')
            ->get()
            ->filter(fn ($user) => $user->stats !== null)
            ->sortByDesc(fn ($user) => $user->stats->xp)
            ->map(fn ($user) => [
                'user' => [
                    'id'         => $user->id,
                    'first_name' => $user->firstname,
                    'last_name'  => $user->lastname,
                    'email'      => $user->email,
                    'xp'         => $user->stats->xp,
                ],
            ])
            ->values();
    
        LeaderboardSnapshot::create([
            'leaderboard' => $leaderboard,
        ]);
    }


    public function getAllTimeLeaderboard(): array
    {
        return LeaderboardSnapshot::latest()->first()?->leaderboard ?? [];
    }

    public function getWeeklyLeaderboard(): array
    {
        return LeaderboardSnapshot::where('created_at', '>=', now()->subWeek())->latest()->first()?->leaderboard ?? [];
    }

    public function getMonthlyLeaderboard(): array
    {
        return LeaderboardSnapshot::where('created_at', '>=', now()->subMonth())->latest()->first()?->leaderboard ?? [];
    }
}
