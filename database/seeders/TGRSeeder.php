<?php

namespace Database\Seeders;

use App\Models\TGR;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TGRSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $TGR = [
            [
                'id' => 1,
                'nama' => 'Ukasya',
                'jenis_kelamin' => 'L',
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kategori' => 'Tunggal',   
            ],
            [
                'id' => 2,
                'nama' => 'Mustavid',
                'jenis_kelamin' => 'L',
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kategori' => 'Tunggal',
            ],
        ];
        TGR::query()->insert($TGR);
    }
}
