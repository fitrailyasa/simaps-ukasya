<?php

namespace Database\Seeders;

use App\Models\Babak;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BabakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Babak = [
            [
                'babak' => 1,
                'atlet'=>1
            ],
            [
                'babak' => 2,
                'atlet'=>1
            ],
            [
                'babak' => 3,
                'atlet'=>1
            ],
            [
                'babak' => 1,
                'atlet'=>2
            ],
            [
                'babak' => 2,
                'atlet'=>2
            ],
            [
                'babak' => 3,
                'atlet'=>2
            ]
        ];
        Babak::query()->insert($Babak);
    }
    
}
