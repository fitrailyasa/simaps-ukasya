<?php

namespace Database\Seeders;

use App\Models\PenaltyTunggal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenaltyTunggalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $PenaltyTunggal = [
            [
                'dewan'=>8,
                'uuid'=>'erer',
                'sudut'=>1,
                'jadwal_tunggal'=>2
            ],
            [
                'dewan'=>8,
                'uuid'=>'erer1',
                'sudut'=>2,
                'jadwal_tunggal'=>2
            ]
        ];
        PenaltyTunggal::query()->insert($PenaltyTunggal);
    }
}
