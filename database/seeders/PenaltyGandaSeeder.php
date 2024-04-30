<?php

namespace Database\Seeders;

use App\Models\PenaltyGanda;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenaltyGandaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $PenaltyGanda = [
            [
                'dewan'=>9,
                'uuid'=>'erer',
                'sudut_merah'=>1,
                'sudut_biru'=>2,
                'jadwal_ganda'=>3
            ]
        ];
        PenaltyGanda::query()->insert($PenaltyGanda);
    }
}
