<?php

namespace Database\Seeders;

use App\Models\PenilaianRegu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenilaianReguSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $PenilaianRegu = [
            [
                'uuid' => 'erer1',
                'jadwal_regu' => 1,
                'sudut_merah'=>1,
                'sudut_biru'=>2,
                'juri'=>12
            ],
            [
                'uuid' => 'erer2',
                'jadwal_tunggal' => 1,
                'sudut_merah'=>1,
                'sudut_biru'=>2,
                'juri'=>13
            ]
        ];
        PenilaianRegu::query()->insert($PenilaianRegu);
    
    }
}
