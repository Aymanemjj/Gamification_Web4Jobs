<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Fetch the role IDs safely from the database
        $superAdminRoleId = DB::table('roles')->where('name', 'super_admin')->value('id');
        $learnerRoleId = DB::table('roles')->where('name', 'learner')->value('id');

        // 1. Insert 1 Super Admin
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@web4jobs.com'], // Unique check
            [
                'firstname' => 'Admin',
                'lastname' => 'User',
                'email_verified_at' => now(),
                'active' => 1,
                'role_id' => $superAdminRoleId,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // 2. Insert 20 Fake Learners
        $learners = [];
        for ($i = 0; $i < 20; $i++) {
            $learners[] = [
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'active' => 1, // 1 = Active
                'role_id' => $learnerRoleId,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Chunk insert for database efficiency
        foreach (array_chunk($learners, 10) as $chunk) {
            DB::table('users')->insert($chunk);
        }
    }
}
