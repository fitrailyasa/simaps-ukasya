<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'id' => 1,
                'name' => 'Admin'
            ],
            [
                'id' => 2,
                'name' => 'Operator'
            ],
            [
                'id' => 3,
                'name' => 'Dewan'
            ],
            [
                'id' => 4,
                'name' => 'Juri'
            ]
        ];
        Role::query()->insert($roles);
    }
}
