<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPlatformAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Get all user IDs currently in the users table
        $userIds = DB::table('users')->pluck('id');

        $accounts = [];
        $startingExternalId = 1001; // Fake sequence for external system IDs

        // 2. Loop through every user and prepare the platform mapping records
        foreach ($userIds as $index => $userId) {
            $accounts[] = [
                'user_id' => $userId,
                'platform_id' => 3,
                'external_id' => $startingExternalId + $index, 
            ];
        }

        // 3. Insert them efficiently using chunking (or updateOrInsert to prevent duplicates)
        foreach (array_chunk($accounts, 10) as $chunk) {
            foreach ($chunk as $account) {
                DB::table('user_platform_accounts')->updateOrInsert(
                    [
                        'platform_id' => $account['platform_id'],
                        'user_id' => $account['user_id'],
                    ],
                    [
                        'external_id' => $account['external_id'],
                    ]
                );
            }
        }
    }
}