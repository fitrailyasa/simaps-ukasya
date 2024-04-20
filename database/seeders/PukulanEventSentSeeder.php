<?php

namespace Database\Seeders;

use App\Models\PukulanEventSent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PukulanEventSentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $PukulanEvent = [
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
        PukulanEventSent::query()->insert($PukulanEvent);
    }
}
