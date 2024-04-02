<?php

namespace App\Imports;

use App\Models\Gelanggang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GelanggangImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Gelanggang([
            'nama' => $row['nama'],
            'waktu' => $row['waktu'],
            'jenis' => $row['jenis'],
        ]);
    }
}
