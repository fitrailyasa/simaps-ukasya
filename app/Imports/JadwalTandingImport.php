<?php

namespace App\Imports;

use App\Models\JadwalTanding;
use App\Models\Gelanggang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JadwalTandingImport implements ToModel, WithHeadingRow
{
    public $teams;

    public function __construct($teams)
    {
        $this->teams = $teams;
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

        $team = $this->teams->where('nomor_undian', $row['nomor_undian'])->first();

        if (!$team) {
            return null;
        }

        return new JadwalTanding([
            'partai' => $row['partai'],
            'gelanggang' => $gelanggang->id,
            'babak' => $row['babak'],
            'sudut_biru' => $row['sudut_biru'],
            'sudut_merah' => $row['sudut_merah'],
            'next_sudut' => $row['next_sudut'],
            'next_partai' => $row['next_partai'],
        ]);
    }
}
