<?php

use App\Jobs\TakeLeaderboardSnapshot;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::job(TakeLeaderboardSnapshot::class)->everyMinute();