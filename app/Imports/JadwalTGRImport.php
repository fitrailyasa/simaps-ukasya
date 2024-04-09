<?php

namespace App\Imports;

use App\Models\JadwalTGR;
use App\Models\Gelanggang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JadwalTGRImport implements ToModel, WithHeadingRow
{
    public $kelompok;

    public function __construct($kelompok)
    {
        $this->kelompok = $kelompok;
    }

    public function model(array $row)
    {
        $gelanggang = Gelanggang::where('nama', $row['gelanggang'])->first();

        if (!$gelanggang) {
            $gelanggang = Gelanggang::create([
                'nama' => $row['gelanggang'],
                'waktu' => 3,
                'jenis' => 'Tunggal',
            ]);
        }

        return new JadwalTGR([
            'partai' => $row['partai'],
            'gelanggang' => $gelanggang->id,
            'babak' => $row['babak'],
            'kelompok' => $this->kelompok,
            'sudut_biru' => $row['sudut_biru'], 
            'sudut_merah' => $row['sudut_merah'],
            'next_sudut' => $row['next_sudut'],
            'next_partai' => $row['next_partai'],
        ]);
    }
}
