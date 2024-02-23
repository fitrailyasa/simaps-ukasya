<?php

namespace App\Imports;

use App\Models\Tanding;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TandingImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Tanding([
            'nama' => $row['nama'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'tinggi_badan' => $row['tinggi_badan'],
            'berat_badan' => $row['berat_badan'],
            'kontingen' => $row['kontingen'],
            'kelas' => $row['kelas'],
            'golongan' => $row['golongan'],
        ]);
    }
}
