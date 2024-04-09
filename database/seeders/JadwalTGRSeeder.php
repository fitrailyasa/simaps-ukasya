<?php

namespace Database\Seeders;

use App\Models\JadwalTGR;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalTGRSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $JadwalTGR = [
            [
                'id' => 1,
                'partai' => 1,
                'gelanggang' => 1,
                'babak' => 'Penyisihan',
                'sudut_biru' => 1,
                'sudut_merah' => 2,
                'next_sudut' => 1,
                'next_partai' => 2,
                'skor_biru' => 0,
                'skor_merah' => 0,
                'pemenang' => 1
            ]
        ];
        JadwalTGR::query()->insert($JadwalTGR);
    }
}
