<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Jurusan;
use App\Exports\SiswaExport;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::get();
        return view('admin.siswa.listsiswa', compact('siswas'));
    }

    public function download()
    {
        return Excel::download(new SiswaExport, 'Data Siswa.xlsx');
    }

    public function upload(Request $request)
    {
        Excel::import(new SiswaImport, $request->data_siswa);
        return redirect()->route('admin.listsiswa')->with('success', 'Data berhasil di upload');
    }
}
