<?php

namespace Database\Seeders;

use App\Models\PengundianTGR;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengundianTGRSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $PengundianTGR = [
            [
                'id' => 1,
                'kelompok' => 1,
                'no_undian' => 1,
                'atlet_id' => 1
            ],
            [
                'id' => 2,
                'kelompok' => 1,
                'no_undian' => 2,
                'atlet_id' => 2
            ],
        ];
        PengundianTGR::query()->insert($PengundianTGR);
    }
}
