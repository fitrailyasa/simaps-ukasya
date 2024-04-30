<?php

namespace Database\Seeders;

use App\Models\PenilaianSolo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenilaianSoloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $PenilaianSolo = [
            [
                'uuid' => 'erer1',
                'jadwal_solo' => 4,
                'sudut'=>1,
                'juri'=>17
            ],
            [
                'uuid' => 'erer2',
                'jadwal_solo' => 4,
                'sudut'=>1,
                'juri'=>18
            ],
        ];
        PenilaianSolo::query()->insert($PenilaianSolo);
    }
}
