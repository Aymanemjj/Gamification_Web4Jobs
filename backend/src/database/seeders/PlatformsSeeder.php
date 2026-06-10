<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlatformsSeeder extends Seeder
{
    public function run(): void
    {
        $platforms = [
            [
                "name" => "web4jobs_progress",
                "weight" => 30,
                "key" => "web4jobs_progress",
            ],
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
