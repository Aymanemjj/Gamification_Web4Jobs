<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetricKeysSeeder extends Seeder
{
    public function run(): void
    {
        $metrics = [
            [
                'name'        => 'passport_numerique_progress',
                'rules'       => ['unit' => 'percentage', 'guide' => ['per' => 1, 'amount' => 1]],
            ],
            [
                'name'        => 'rna_progress',
                'rules'       => ['unit' => 'percentage', 'guide' => ['per' => 1, 'amount' => 1]],
            ],
            [
                'name'        => 'linkedin_formation_progress',
                'rules'       => ['unit' => 'percentage', 'guide' => ['per' => 1, 'amount' => 1]],
            ],
            [
                'name'        => 'pm_formation_progress',
                'rules'       => ['unit' => 'percentage', 'guide' => ['per' => 1, 'amount' => 1]],
            ],
            [
                'name'        => 'daily_login',
                'rules'       => ['unit' => 'daily', 'guide' => ['amount' => 2]],
            ],
            [
                'name'        => 'module_completed',
                'rules'       => ['unit' => 'per_event', 'guide' => ['amount' => 10]],
            ],
            [
                'name'        => 'chapter_completed',
                'rules'       => ['unit' => 'per_event', 'guide' => ['amount' => 5]],
            ],
            [
                'name'        => 'challenge_completed',
                'rules'       => ['unit' => 'per_event', 'guide' => ['amount' => 15]],
            ],
            [
                'name'        => 'quiz_completed',
                'rules'       => ['unit' => 'per_event', 'guide' => ['amount' => 10]],
            ],
        ];

        foreach ($metrics as $metric) {
            DB::table('metric_keys')->insert([
                'platform_id' => 1,
                'name'        => $metric['name'],
                'rules'       => json_encode($metric['rules']),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
