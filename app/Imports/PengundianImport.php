<?php

namespace App\Imports;

use App\Models\Pengundian;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PengundianImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Pengundian([
            'nama' => $row['nama'],
            'golongan' => $row['golongan'],
            'kelas_kategori' => $row['kelas_kategori'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'kontingen' => $row['kontingen'],
            'no_undian' => $row['no_undian'],
        ]);
    }
}
