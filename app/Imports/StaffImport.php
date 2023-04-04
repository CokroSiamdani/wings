<?php

namespace App\Imports;

use App\Staff;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StaffImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd($row['nama_staff']);
        return new Staff([
            'nama_staff' => $row['nama_staff'],
            'position' => $row['position'],
            'division' => $row['division']
        ]);
    }
}
