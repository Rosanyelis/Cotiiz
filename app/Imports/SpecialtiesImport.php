<?php

namespace App\Imports;

use App\Models\Specialty;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SpecialtiesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Specialty([
            'name'     => Str::ucfirst($row['especialidades']),
        ]);
    }
}
