<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'learner', 'permissions' => '[]'],               // Apprenants
            ['name' => 'center_manager', 'permissions' => '[]'],       // Responsables de centre
            ['name' => 'product_pedagogical_team', 'permissions' => '[]'], // Équipe produit / pédagogique
            ['name' => 'super_admin', 'permissions' => '*'],            // Administrateurs
        ];

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(
                ['name' => $role['name']],
                [
                    'permissions' => $role['permissions'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
