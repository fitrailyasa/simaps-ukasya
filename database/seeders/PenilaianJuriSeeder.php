<?php

namespace Database\Seeders;

use App\Models\PenilaianJuri;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenilaianJuriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $PenilaianJuri = [
            [
                'uuid' => 'erer6',
                'sudut' => 1,
                'juri'=>12,
                'gelanggang'=>1,
                'partai' => 1            
            ],
            [
                'uuid' => 'erer5',
                'sudut' => 1,
                'juri'=>13,
                'gelanggang'=>1,
                'partai' => 1            
            ],
            [
                'uuid' => 'erer7',
                'sudut' => 1,
                'juri'=>14,
                'gelanggang'=>1,
                'partai' => 1            
            ],
            [
                'uuid' => 'erer8',
                'sudut' => 2,
                'juri'=>12,
                'gelanggang'=>1,
                'partai' => 1
            

            ],
            [
                'uuid' => 'erer9',
                'sudut' => 2,
                'juri'=>13,
                'gelanggang'=>1,
                'partai' => 1
 

            ],
            [
                'uuid' => 'erer0',
                'sudut' => 2,
                'juri'=>14,
                'gelanggang'=>1,
                'partai' => 1

            ]
        ];
        PenilaianJuri::query()->insert($PenilaianJuri);
    }
}
