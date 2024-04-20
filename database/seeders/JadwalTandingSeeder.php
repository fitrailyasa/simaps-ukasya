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
                'kelas'=> 'A',
                'sudut_biru' => 1,
                'sudut_merah' => 2,
                'next_sudut' => 1,
                'next_partai' => 2,
                'pemenang' => 2,
                'tahap'=>'persiapan'
            ]
        ];
        JadwalTanding::query()->insert($JadwalTanding);
    }
}
