<?php

namespace Database\Seeders;

use App\Models\TendanganEventSent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TendanganEventSentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $TendanganEvent = [
            [
                'id' => 1,
                'uuid'=>'tes1',
                'jadwal_tanding'=>1,
                'sudut'=>1
            ],
             [
                'id' => 2,
                'uuid'=>'tes2',
                'jadwal_tanding'=>1,
                'sudut'=>2
            ]
        ];
        TendanganEventSent::query()->insert($TendanganEvent);
    }
}
