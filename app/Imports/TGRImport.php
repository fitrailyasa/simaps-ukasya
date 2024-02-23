<?php

namespace App\Imports;

use App\Models\TGR;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TGRImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new TGR([
            'nama' => $row['nama'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'kontingen' => $row['kontingen'],
            'kategori' => $row['kategori'],
            'golongan' => $row['golongan'],
        ]);
    }
}
