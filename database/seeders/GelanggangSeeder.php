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
                'audio' => 'audio.mp3',
                'jenis' => 'Tanding',
                'jumlah_tanding' => 0,
                'jumlah_tgr' => 0
            ],
            [
                'id' => 2,
                'nama' => 'ARENA B',
                'waktu' => 3,
                'audio' => 'audio.mp3',
                'jenis' => 'Tunggal',
                'jumlah_tanding' => 0,
                'jumlah_tgr' => 0
            ],
            [
                'id' => 3,
                'nama' => 'ARENA C',
                'waktu' => 3,
                'audio' => 'audio.mp3',
                'jenis' => 'Ganda',
                'jumlah_tanding' => 0,
                'jumlah_tgr' => 0
            ],
            [
                'id' => 4,
                'nama' => 'ARENA D',
                'waktu' => 3,
                'audio' => 'audio.mp3',
                'jenis' => 'Regu',
                'jumlah_tanding' => 0,
                'jumlah_tgr' => 0
            ]
        ];
        Gelanggang::query()->insert($Gelanggang);
    }
}
