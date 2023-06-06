<?php

namespace App\Imports;

use App\Models\Guru;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GuruImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Guru([
            'nomer_induk' => $row[0],
            'nama' => $row[1],
            'alamat' => $row[2],
            'jk' => $row[3],
            'notelp' => $row[4],
        ]);
    }
}
