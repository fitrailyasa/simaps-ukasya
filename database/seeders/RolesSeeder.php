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
                'name' => 'Operator'
            ],
            [
                'id' => 2,
                'name' => 'Juri'
            ],
            [
                'id' => 3,
                'name' => 'Dewan'
            ]
        ];
        Role::query()->insert($roles);
    }
}
