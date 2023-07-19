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
            'id_kelas' => $row[2],
            'id_tahun' => $row[3],
            'nama' => $row[4],
            'alamat' => $row[5],
            'jk' => $row[6],
            'notelp' => $row[7],
        ]);
    }
}
