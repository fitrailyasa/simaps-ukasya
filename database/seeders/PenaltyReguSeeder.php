<?php

namespace Database\Seeders;

use App\Models\PenaltyRegu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenaltyReguSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $PenaltyRegu = [
            [
                'dewan'=>10,
                'uuid'=>'erer',
                'sudut_merah'=>1,
                'sudut_biru'=>2,
                'jadwal_regu'=>1
            ]
        ];
        PenaltyRegu::query()->insert($PenaltyRegu);
    }
}
