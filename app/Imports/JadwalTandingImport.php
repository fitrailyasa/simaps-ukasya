<?php

namespace App\Imports;

use App\Models\JadwalTanding;
use App\Models\PengundianTanding;
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

        // Lakukan pencarian sudut biru berdasarkan filter yang diterapkan pada koleksi $teams
        $sudutBiru = $this->teams->first(function ($team) use ($row) {
            return $team->no_undian == $row['sudut_biru'];
        });

        // Lakukan pencarian sudut merah berdasarkan filter yang diterapkan pada koleksi $teams
        $sudutMerah = $this->teams->first(function ($team) use ($row) {
            return $team->no_undian == $row['sudut_merah'];
        });

        // dd($sudutBiru, $sudutMerah);

        return new JadwalTanding([
            'partai' => $row['partai'],
            'gelanggang' => $gelanggang->id,
            'babak' => $row['babak'],
            'sudut_biru' => $sudutBiru ? $sudutBiru->id : null, // Gunakan id sudut biru jika ditemukan, jika tidak, gunakan null
            'sudut_merah' => $sudutMerah ? $sudutMerah->id : null, // Gunakan id sudut merah jika ditemukan, jika tidak, gunakan null
            'next_sudut' => $row['next_sudut'],
            'next_partai' => $row['next_partai'],
        ]);
    }
}
