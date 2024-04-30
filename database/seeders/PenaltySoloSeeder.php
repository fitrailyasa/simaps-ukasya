<?php

namespace Database\Seeders;

use App\Models\PenaltySolo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenaltySoloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $PenaltySolo = [
            [
                'dewan'=>11,
                'uuid'=>'erer',
                'sudut'=>1,
                'jadwal_solo'=>4
            ]
        ];
        PenaltySolo::query()->insert($PenaltySolo);
    }
}
