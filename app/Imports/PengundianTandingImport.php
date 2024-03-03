<?php

namespace App\Imports;

use App\Models\PengundianTanding;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PengundianTandingImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new PengundianTanding([
            'atlet_id' => $row['atlet_id'],
            'no_undian' => $row['no_undian'],
        ]);
    }
}
