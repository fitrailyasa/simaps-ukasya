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
                'jenis_kelamin' => 'Putra',
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kategori' => 'Tunggal',
            ],
            [
                'id' => 2,
                'nama' => 'Mustavid',
                'jenis_kelamin' => 'Putra',
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kategori' => 'Tunggal',
            ],
            [
                'id' => 3,
                'nama' => 'Mustavid 2',
                'jenis_kelamin' => 'Putra',
                'kontingen' => 'ASAD',
                'golongan' => 'Dewasa',
                'kategori' => 'Ganda',
            ],
        ];
        TGR::query()->insert($TGR);
    }
}
