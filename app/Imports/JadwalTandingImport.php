<?php

namespace App\Imports;

use App\Models\JadwalTanding;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JadwalTandingImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new JadwalTanding([
            'partai' => $row['partai'],
            'gelanggang' => $row['gelanggang'],
            'babak' => $row['babak'],
            'sudut_biru' => $row['sudut_biru'], 
            'sudut_merah' => $row['sudut_merah'],
            'next_sudut' => $row['next_sudut'],
            'next_partai' => $row['next_partai'],
        ]);
    }
}
