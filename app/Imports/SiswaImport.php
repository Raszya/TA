<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Siswa([
            'nis' => $row[0],
            'id_jurusan' => $row[1],
            'nama' => $row[2],
            'alamat' => $row[3],
            'jk' => $row[4],
            'notelp' => $row[5],
        ]);
    }
}
