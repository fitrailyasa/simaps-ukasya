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
                'nama' => 'User 1',
                'jenis_kelamin' => 'Putra',
                'tinggi_badan' => 180,
                'berat_badan' => 70,
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kelas' => 'Kelas C',
            ],
            [
                'id' => 2,
                'nama' => 'User 2',
                'jenis_kelamin' => 'Putra',
                'tinggi_badan' => 180,
                'berat_badan' => 70,
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kelas' => 'Kelas C',
            ],
            [
                'id' => 3,
                'nama' => 'User 3',
                'jenis_kelamin' => 'Putra',
                'tinggi_badan' => 180,
                'berat_badan' => 70,
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kelas' => 'Kelas C',
            ],
            [
                'id' => 4,
                'nama' => 'User 4',
                'jenis_kelamin' => 'Putra',
                'tinggi_badan' => 180,
                'berat_badan' => 70,
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kelas' => 'Kelas C',
            ],
            [
                'id' => 5,
                'nama' => 'User 5',
                'jenis_kelamin' => 'Putra',
                'tinggi_badan' => 180,
                'berat_badan' => 70,
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kelas' => 'Kelas C',
            ],
            [
                'id' => 6,
                'nama' => 'User 6',
                'jenis_kelamin' => 'Putra',
                'tinggi_badan' => 180,
                'berat_badan' => 70,
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kelas' => 'Kelas C',
            ],
            [
                'id' => 7,
                'nama' => 'User 7',
                'jenis_kelamin' => 'Putra',
                'tinggi_badan' => 180,
                'berat_badan' => 70,
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kelas' => 'Kelas C',
            ],
            [
                'id' => 8,
                'nama' => 'User 8',
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
