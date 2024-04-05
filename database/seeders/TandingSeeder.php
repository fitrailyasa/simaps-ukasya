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
                'jenis_kelamin' => 'L',
                'tinggi_badan' => 180,
                'berat_badan' => 70,
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kelas' => 'Kelas A',   
            ],
            [
                'id' => 2,
                'nama' => 'Mustavid',
                'jenis_kelamin' => 'L',
                'tinggi_badan' => 180,
                'berat_badan' => 70,
                'kontingen' => 'ASAD',
                'golongan' => 'Remaja',
                'kelas' => 'Kelas A',   
            ],
            [
                'id' => 3,
                'nama' => 'Mustavid 2',
                'jenis_kelamin' => 'L',
                'tinggi_badan' => 180,
                'berat_badan' => 76,
                'kontingen' => 'ASAD',
                'golongan' => 'Dewasa',
                'kelas' => 'Kelas B',   
            ],
        ];
        Tanding::query()->insert($Tanding);
    }
}
