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
                'nama' => 'User 1',
                'jenis_kelamin' => 'Putra',
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kategori' => 'Tunggal',
            ],
            [
                'id' => 2,
                'nama' => 'User 2',
                'jenis_kelamin' => 'Putra',
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kategori' => 'Tunggal',
            ],
            [
                'id' => 3,
                'nama' => 'User 3',
                'jenis_kelamin' => 'Putra',
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kategori' => 'Tunggal',
            ],
            [
                'id' => 4,
                'nama' => 'User 4',
                'jenis_kelamin' => 'Putra',
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kategori' => 'Tunggal',
            ],
            [
                'id' => 5,
                'nama' => 'User 5',
                'jenis_kelamin' => 'Putra',
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kategori' => 'Tunggal',
            ],
            [
                'id' => 6,
                'nama' => 'User 6',
                'jenis_kelamin' => 'Putra',
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kategori' => 'Tunggal',
            ],
            [
                'id' => 7,
                'nama' => 'User 7',
                'jenis_kelamin' => 'Putra',
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kategori' => 'Tunggal',
            ],
            [
                'id' => 8,
                'nama' => 'User 8',
                'jenis_kelamin' => 'Putra',
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kategori' => 'Tunggal',
            ],
        ];
        TGR::query()->insert($TGR);
    }
}
