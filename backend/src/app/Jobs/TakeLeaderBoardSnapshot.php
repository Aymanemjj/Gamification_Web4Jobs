<?php

namespace App\Jobs;

use App\Services\LeaderboardService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class TakeLeaderboardSnapshot implements ShouldQueue
{
    use Queueable;

    public function handle(LeaderboardService $leaderboardService): void
    {
        $leaderboardService->makeSnapshot();
    }
}