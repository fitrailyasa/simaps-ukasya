<?php

namespace Database\Seeders;

use App\Models\Gelanggang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GelanggangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Gelanggang = [
            [
                'id' => 1,
                'nama' => 'ARENA A',
                'waktu' => 3,
                'jenis' => 'Tanding',
                'jadwal'=>1
            ],
            [
                'id' => 2,
                'nama' => 'ARENA B',
                'waktu' => 3,
                'jenis' => 'Tunggal',
                'jadwal'=>1

            ],
            [
                'id' => 3,
                'nama' => 'ARENA C',
                'waktu' => 3,
                'jenis' => 'Ganda',
                'jadwal'=>1
            ],
            [
                'id' => 4,
                'nama' => 'ARENA D',
                'waktu' => 3,
                'jenis' => 'Regu',
                'jadwal'=>1
            ],
            [
                'id' => 5,
                'nama' => 'ARENA E',
                'waktu' => 3,
                'jenis' => 'Solo_Kreatif',
                'jadwal'=>1
            ]
        ];
        Gelanggang::query()->insert($Gelanggang);
    }
}
