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
                'gelanggang' => 4,
                'babak' => 'Penyisihan',
                'sudut_biru' => 2,
                'sudut_merah' => 1,
                'next_sudut' => 1,
                'next_partai' => 2,
                'skor_biru' => 0,
                'skor_merah' => 0,
                'pemenang' => 1
            ],
            [
                'id' => 2,
                'partai' => 1,
                'gelanggang' => 2,
                'babak' => 'Penyisihan',
                'sudut_biru' => 2,
                'sudut_merah' => 1,
                'next_sudut' => 1,
                'next_partai' => 3,
                'skor_biru' => 0,
                'skor_merah' => 0,
                'pemenang' => 1
            ],
            [
                'id' => 3,
                'partai' => 3,
                'gelanggang' => 3,
                'babak' => 'Penyisihan',
                'sudut_biru' => 2,
                'sudut_merah' => 1,
                'next_sudut' => 1,
                'next_partai' => 4,
                'skor_biru' => 0,
                'skor_merah' => 0,
                'pemenang' => 1
            ],
            [
                'id' => 4,
                'partai' => 4,
                'gelanggang' => 5,
                'babak' => 'Penyisihan',
                'sudut_biru' => 1,
                'sudut_merah' => 1,
                'next_sudut' => 1,
                'next_partai' => 5,
                'skor_biru' => 0,
                'skor_merah' => 0,
                'pemenang' => 1
            ]
        ];
        JadwalTGR::query()->insert($JadwalTGR);
    }
}
