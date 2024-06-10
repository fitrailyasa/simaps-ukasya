<?php

namespace Database\Seeders;

use App\Models\Tanding;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TandingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Tanding = [
            [
                'id' => 1,
                'nama' => 'Ukasya',
                'jenis_kelamin' => 'Putra',
                'tinggi_badan' => 180,
                'berat_badan' => 70,
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kelas' => 'Kelas C',
            ],
            [
                'id' => 2,
                'nama' => 'Mustavid',
                'jenis_kelamin' => 'Putra',
                'tinggi_badan' => 180,
                'berat_badan' => 70,
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kelas' => 'Kelas C',
            ],
            [
                'id' => 3,
                'nama' => 'Ukasya 2',
                'jenis_kelamin' => 'Putra',
                'tinggi_badan' => 180,
                'berat_badan' => 70,
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kelas' => 'Kelas C',
            ],
            [
                'id' => 4,
                'nama' => 'Mustavid 2',
                'jenis_kelamin' => 'Putra',
                'tinggi_badan' => 180,
                'berat_badan' => 70,
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kelas' => 'Kelas C',
            ],
            [
                'id' => 5,
                'nama' => 'Ukasya 3',
                'jenis_kelamin' => 'Putra',
                'tinggi_badan' => 180,
                'berat_badan' => 70,
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kelas' => 'Kelas C',
            ],
            [
                'id' => 6,
                'nama' => 'Mustavid 3',
                'jenis_kelamin' => 'Putra',
                'tinggi_badan' => 180,
                'berat_badan' => 70,
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kelas' => 'Kelas C',
            ],
            [
                'id' => 7,
                'nama' => 'Ukasya 4',
                'jenis_kelamin' => 'Putra',
                'tinggi_badan' => 180,
                'berat_badan' => 70,
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kelas' => 'Kelas C',
            ],
            [
                'id' => 8,
                'nama' => 'Mustavid 4',
                'jenis_kelamin' => 'Putra',
                'tinggi_badan' => 180,
                'berat_badan' => 70,
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kelas' => 'Kelas C',
            ],
        ];
        Tanding::query()->insert($Tanding);
    }
}
