<?php

namespace Database\Seeders;

use App\Models\PenilaianTanding;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenilaianTandingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $PenilaianTanding = [
            [
                'uuid' => 'erer6',
                'babak' => 1,
                'jadwal_tanding'=>1,
                'atlet'=>1
            ],
            [
                'uuid' => 'erer5',
                'babak' => 2,
                'jadwal_tanding'=>1,
                'atlet'=>1
            ],
            [
                'uuid' => 'erer4',
                'babak' => 3,
                'jadwal_tanding'=>1,
                'atlet'=>1
            ],
            [
                'uuid' => 'erer3',
                'babak' => 1,
                'jadwal_tanding'=>1,
                'atlet'=>2
            ],
            [
                'uuid' => 'erer2',
                'babak' => 2,
                'jadwal_tanding'=>1,
                'atlet'=>2
            ],
            [
                'uuid' => 'erer1',
                'babak' => 3,
                'jadwal_tanding'=>1,
                'atlet'=>2
            ]
        ];
        PenilaianTanding::query()->insert($PenilaianTanding);
    }
    
}
