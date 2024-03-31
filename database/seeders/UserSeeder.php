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
                'gelanggang' => 1,
                'status' => 1,
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Operator',
                'email' => 'operator@simaps.com',
                'roles_id' => 2,
                'gelanggang' => 1,
                'status' => 1,
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri',
                'email' => 'juri@simaps.com',
                'roles_id' => 2,
                'gelanggang' => 1,
                'status' => 1,
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Dewan',
                'email' => 'dewan@simaps.com',
                'roles_id' => 3,
                'gelanggang' => 1,
                'status' => 1,
                'password' => Hash::make('password')
            ],
        ];
        User::query()->insert($users);
    }
}
