<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PlatformsSeeder::class,
            MetricKeysSeeder::class,
            EventTypeSeeder::class,
            MetricKeySeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            UserPlatformAccountSeeder::class
        ]);
    }
}