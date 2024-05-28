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
                'permissions' => 'Admin',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Operator A',
                'email' => 'operator1@simaps.com',
                'roles_id' => 2,
                'gelanggang' => 1,
                'status' => 1,
                'permissions' => 'Operator',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Operator B',
                'email' => 'operator2@simaps.com',
                'roles_id' => 2,
                'gelanggang' => 2,
                'status' => 1,
                'permissions' => 'Operator',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Operator C',
                'email' => 'operator3@simaps.com',
                'roles_id' => 2,
                'gelanggang' => 3,
                'status' => 1,
                'permissions' => 'Operator',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Operator D',
                'email' => 'operator4@simaps.com',
                'roles_id' => 2,
                'gelanggang' => 4,
                'status' => 1,
                'permissions' => 'Operator',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Operator E',
                'email' => 'operator5@simaps.com',
                'roles_id' => 2,
                'gelanggang' => 5,
                'status' => 1,
                'permissions' => 'Operator',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Dewan A',
                'email' => 'dewan1@simaps.com',
                'roles_id' => 3,
                'gelanggang' => 1,
                'status' => 1,
                'permissions' => 'Dewan',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Dewan B',
                'email' => 'dewan2@simaps.com',
                'roles_id' => 3,
                'gelanggang' => 2,
                'status' => 1,
                'permissions' => 'Dewan',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Dewan C',
                'email' => 'dewan3@simaps.com',
                'roles_id' => 3,
                'gelanggang' => 3,
                'status' => 1,
                'permissions' => 'Dewan',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Dewan D',
                'email' => 'dewan4@simaps.com',
                'roles_id' => 3,
                'gelanggang' => 4,
                'status' => 1,
                'permissions' => 'Dewan',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Dewan E',
                'email' => 'dewan5@simaps.com',
                'roles_id' => 3,
                'gelanggang' => 5,
                'status' => 1,
                'permissions' => 'Dewan',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri A',
                'email' => 'juri1@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 1,
                'status' => 1,
                'permissions' => 'Juri 1',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri B',
                'email' => 'juri2@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 1,
                'status' => 1,
                'permissions' => 'Juri 2',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri C',
                'email' => 'juri3@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 1,
                'status' => 1,
                'permissions' => 'Juri 3',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri D',
                'email' => 'juri4@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 1,
                'status' => 0,
                'permissions' => 'Juri 4',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri E',
                'email' => 'juri5@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 1,
                'status' => 0,
                'permissions' => 'Juri 5',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri F',
                'email' => 'juri6@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 1,
                'status' => 0,
                'permissions' => 'Juri 6',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri G',
                'email' => 'juri7@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 1,
                'status' => 0,
                'permissions' => 'Juri 7',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri H',
                'email' => 'juri8@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 1,
                'status' => 0,
                'permissions' => 'Juri 8',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri I',
                'email' => 'juri9@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 1,
                'status' => 0,
                'permissions' => 'Juri 9',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri J',
                'email' => 'juri10@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 1,
                'status' => 0,
                'permissions' => 'Juri 10',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri A',
                'email' => 'juri11@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 2,
                'status' => 1,
                'permissions' => 'Juri 1',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri B',
                'email' => 'juri12@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 2,
                'status' => 1,
                'permissions' => 'Juri 2',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri C',
                'email' => 'juri13@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 2,
                'status' => 1,
                'permissions' => 'Juri 3',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri D',
                'email' => 'juri14@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 2,
                'status' => 1,
                'permissions' => 'Juri 4',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri E',
                'email' => 'juri15@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 2,
                'status' => 0,
                'permissions' => 'Juri 5',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri F',
                'email' => 'juri16@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 2,
                'status' => 0,
                'permissions' => 'Juri 6',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri G',
                'email' => 'juri17@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 2,
                'status' => 0,
                'permissions' => 'Juri 7',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri H',
                'email' => 'juri18@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 2,
                'status' => 0,
                'permissions' => 'Juri 8',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri I',
                'email' => 'juri19@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 2,
                'status' => 0,
                'permissions' => 'Juri 9',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri J',
                'email' => 'juri20@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 2,
                'status' => 0,
                'permissions' => 'Juri 10',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri A',
                'email' => 'juri21@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 3,
                'status' => 1,
                'permissions' => 'Juri 1',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri B',
                'email' => 'juri22@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 3,
                'status' => 1,
                'permissions' => 'Juri 2',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri C',
                'email' => 'juri23@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 3,
                'status' => 1,
                'permissions' => 'Juri 3',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri D',
                'email' => 'juri24@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 3,
                'status' => 1,
                'permissions' => 'Juri 4',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri E',
                'email' => 'juri25@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 3,
                'status' => 0,
                'permissions' => 'Juri 5',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri F',
                'email' => 'juri26@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 3,
                'status' => 0,
                'permissions' => 'Juri 6',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri G',
                'email' => 'juri27@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 3,
                'status' => 0,
                'permissions' => 'Juri 7',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri H',
                'email' => 'juri28@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 3,
                'status' => 0,
                'permissions' => 'Juri 8',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri I',
                'email' => 'juri29@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 3,
                'status' => 0,
                'permissions' => 'Juri 9',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri J',
                'email' => 'juri30@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 3,
                'status' => 0,
                'permissions' => 'Juri 10',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri A',
                'email' => 'juri31@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 4,
                'status' => 1,
                'permissions' => 'Juri 1',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri B',
                'email' => 'juri32@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 4,
                'status' => 1,
                'permissions' => 'Juri 2',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri C',
                'email' => 'juri33@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 4,
                'status' => 1,
                'permissions' => 'Juri 3',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri D',
                'email' => 'juri34@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 4,
                'status' => 1,
                'permissions' => 'Juri 4',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri E',
                'email' => 'juri35@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 4,
                'status' => 0,
                'permissions' => 'Juri 5',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri F',
                'email' => 'juri36@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 4,
                'status' => 0,
                'permissions' => 'Juri 6',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri G',
                'email' => 'juri37@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 4,
                'status' => 0,
                'permissions' => 'Juri 7',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri H',
                'email' => 'juri38@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 4,
                'status' => 0,
                'permissions' => 'Juri 8',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri I',
                'email' => 'juri39@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 4,
                'status' => 0,
                'permissions' => 'Juri 9',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri J',
                'email' => 'juri40@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 4,
                'status' => 0,
                'permissions' => 'Juri 10',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri A',
                'email' => 'juri41@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 5,
                'status' => 1,
                'permissions' => 'Juri 1',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri B',
                'email' => 'juri42@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 5,
                'status' => 1,
                'permissions' => 'Juri 2',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri C',
                'email' => 'juri43@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 5,
                'status' => 1,
                'permissions' => 'Juri 3',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri D',
                'email' => 'juri44@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 5,
                'status' => 1,
                'permissions' => 'Juri 4',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri E',
                'email' => 'juri45@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 5,
                'status' => 0,
                'permissions' => 'Juri 5',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri F',
                'email' => 'juri46@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 5,
                'status' => 0,
                'permissions' => 'Juri 6',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri G',
                'email' => 'juri47@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 5,
                'status' => 0,
                'permissions' => 'Juri 7',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri H',
                'email' => 'juri48@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 5,
                'status' => 0,
                'permissions' => 'Juri 8',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri I',
                'email' => 'juri49@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 5,
                'status' => 0,
                'permissions' => 'Juri 9',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Juri J',
                'email' => 'juri50@simaps.com',
                'roles_id' => 4,
                'gelanggang' => 5,
                'status' => 0,
                'permissions' => 'Juri 10',
                'password' => Hash::make('password')
            ],
        ];
        User::query()->insert($users);
    }
}
