<?php

namespace Database\Seeders;

use App\Models\PenilaianGanda;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenilaianGandaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $PenilaianGanda = [
            [
                'uuid' => 'erer1',
                'jadwal_ganda' => 3,
                'sudut_merah'=>1,
                'sudut_biru'=>2,
                'juri'=>15
            ]
        ];
        PenilaianGanda::query()->insert($PenilaianGanda);
    }
}
