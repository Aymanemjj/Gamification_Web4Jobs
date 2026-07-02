<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventTypes = [
            'profile_completion_updated',
            'external_profile_completion_updated',
            'cv_uploaded',
            'portfolio_completed',
            'offer_applied',
            'offer_won',
            'freelance_mission_won',
        ];

        foreach ($eventTypes as $type) {
            DB::table('event_types')->updateOrInsert(
                [
                    'platform_id' => 3,
                    'type' => $type,
                ]
            );
        }
    }
}