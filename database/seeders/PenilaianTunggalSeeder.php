<?php

namespace Database\Seeders;

use App\Models\PenilaianTunggal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenilaianTunggalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $PenilaianTunggal = [
            [
                'uuid' => 'erer1',
                'jadwal_tunggal' => 2,
                'sudut'=>1,
                'juri'=>16
            ],
            [
                'uuid' => 'erer2',
                'jadwal_tunggal' => 2,
                'sudut'=>2,
                'juri'=>16
            ],
        ];
        PenilaianTunggal::query()->insert($PenilaianTunggal);
    }
}
