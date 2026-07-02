<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetricKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $metricKeys = [
            'insertion_profile_completion',
            'external_job_platform_profile_completion',
            'cv_uploaded',
            'portfolio_completed',
            'job_offer_applied',
            'job_offer_won',
            'freelance_mission_won',
        ];

        foreach ($metricKeys as $key) {
            // updateOrInsert prevents duplicate rows if you run the seeder multiple times
            DB::table('metric_keys')->updateOrInsert(
                [
                    'platform_id' => 3,
                    'name' => $key,
                ],
                [
                    'rules' => '[]', // Initializing required non-nullable longtext column
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}