<?php

namespace Database\Seeders;

use App\Models\JadwalTanding;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalTandingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $JadwalTanding = [
            [
                'id' => 1,
                'partai' => 1,
                'gelanggang' => 1,
                'babak' => 'Penyisihan',
                'sudut_biru' => 1,
                'sudut_merah' => 2,
                'next_sudut' => 1,
                'next_partai' => 3,
                'pemenang' => 2,
                'tahap' => 'persiapan'
            ],
            [
                'id' => 2,
                'partai' => 2,
                'gelanggang' => 1,
                'babak' => 'Penyisihan',
                'sudut_biru' => 3,
                'sudut_merah' => 4,
                'next_sudut' => 2,
                'next_partai' => 3,
                'pemenang' => 4,
                'tahap' => 'persiapan'
            ],
            [
                'id' => 3,
                'partai' => 2,
                'gelanggang' => 1,
                'babak' => 'Semi Final',
                'sudut_biru' => 3,
                'sudut_merah' => 4,
                'next_sudut' => 2,
                'next_partai' => 3,
                'pemenang' => 4,
                'tahap' => 'persiapan'
            ],
        ];
        JadwalTanding::query()->insert($JadwalTanding);
    }
}
