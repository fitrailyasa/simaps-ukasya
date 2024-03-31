<?php

namespace App\Imports;

use App\Models\PengundianTGR;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PengundianTGRImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new PengundianTGR([
            'atlet_id' => $row['atlet_id'],
            'no_undian' => $row['no_undian'],
        ]);
    }
}
