<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'roles_id' => 1,
                'gelanggang' => null,
                'status' => 1,
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Operator A',
                'email' => 'operator1@simaps.com',
                'roles_id' => 2,
                'gelanggang' => 1,
                'status' => 1,
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Operator B',
                'email' => 'operator2@simaps.com',
                'roles_id' => 2,
                'gelanggang' => 2,
                'status' => 1,
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Operator C',
                'email' => 'operator3@simaps.com',
                'roles_id' => 2,
                'gelanggang' => 3,
                'status' => 1,
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Operator D',
                'email' => 'operator4@simaps.com',
                'roles_id' => 2,
                'gelanggang' => 4,
                'status' => 1,
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Operator E',
                'email' => 'operator5@simaps.com',
                'roles_id' => 2,
                'gelanggang' => 5,
                'status' => 1,
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Dewan A',
                'email' => 'dewan1@simaps.com',
                'roles_id' => 3,
                'gelanggang' => 1,
                'status' => 1,
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Dewan B',
                'email' => 'dewan2@simaps.com',
                'roles_id' => 3,
                'gelanggang' => 2,
                'status' => 1,
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Dewan C',
                'email' => 'dewan3@simaps.com',
                'roles_id' => 3,
                'gelanggang' => 3,
                'status' => 1,
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Dewan D',
                'email' => 'dewan4@simaps.com',
                'roles_id' => 3,
                'gelanggang' => 4,
                'status' => 1,
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Dewan E',
                'email' => 'dewan5@simaps.com',
                'roles_id' => 3,
                'gelanggang' => 5,
                'status' => 1,
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri A',
                'email' => 'juri1@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 1,
                'status' => 1,
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri B',
                'email' => 'juri2@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 1,
                'status' => 1,
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri C',
                'email' => 'juri3@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 1,
                'status' => 1,
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri D',
                'email' => 'juri4@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 4,
                'status' => 1,
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri E',
                'email' => 'juri5@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 5,
                'status' => 1,
                'password' => Hash::make('password')
            ],
        ];
        User::query()->insert($users);
    }
}
