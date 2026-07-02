<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlatformsSeeder extends Seeder
{
    public function run(): void
    {
        $platforms = [
            ['name' => 'web4jobs_progress',     'key' => 'web4jobs_progress',     'weight' => 25],
            ['name' => 'manual_contribution',   'key' => 'manual_contribution',   'weight' => 20],
            ['name' => 'insertion_platform',    'key' => 'insertion_platform',    'weight' => 15],
            ['name' => 'forum_discord',         'key' => 'forum_discord',         'weight' => 10],
            ['name' => 'certification_platform','key' => 'certification_platform','weight' => 20],
            ['name' => 'attendance_center',     'key' => 'attendance_center',     'weight' => 10],
        ];

        foreach ($platforms as $platform) {
            DB::table("platforms")->insert([
                ...$platform,
                "created_at" => now(),
                "updated_at" => now(),
            ]);
        }
    }
}
