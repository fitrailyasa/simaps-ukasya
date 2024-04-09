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
            ],
            [
                'id' => 2,
                'nama' => 'ARENA B',
                'waktu' => 3,
                'jenis' => 'Tunggal',
            ],
            [
                'id' => 3,
                'nama' => 'ARENA C',
                'waktu' => 3,
                'jenis' => 'Ganda',
            ],
            [
                'id' => 4,
                'nama' => 'ARENA D',
                'waktu' => 3,
                'jenis' => 'Regu',
            ],
            [
                'id' => 5,
                'nama' => 'ARENA E',
                'waktu' => 3,
                'jenis' => 'Solo Kreatif',
            ]
        ];
        Gelanggang::query()->insert($Gelanggang);
    }
}
