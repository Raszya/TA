<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Exports\SiswaExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;


class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::get();
        return view('admin.user.listsiswa', compact('siswas'));
    }

    public function download()
    {
        return Excel::download(new SiswaExport, 'Data Siswa.xlsx');
    }
}
