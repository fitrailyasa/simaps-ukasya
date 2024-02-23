<?php

namespace App\Imports;

use App\Models\Jadwal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JadwalImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Jadwal([
            'partai' => $row['partai'],
            'tanggal' => $row['tanggal'],
            'gelanggang' => $row['gelanggang'],
            'babak' => $row['babak'],
            'kelompok' => $row['kelompok'],
            'pemain_biru' => $row['pemain_biru'],
            'partai_biru' => $row['partai_biru'],
            'pemain_merah' => $row['pemain_merah'],
            'partai_merah' => $row['partai_merah'],
            'status' => $row['status'],
            'pemenang' => $row['pemenang'],
            'aktif' => $row['aktif'],
        ]);
    }
}
