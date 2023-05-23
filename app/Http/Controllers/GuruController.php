<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Exports\GuruExport;
use App\Imports\GuruImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::get();
        return view('admin.guru.listguru', compact('gurus'));
    }

    public function download()
    {
        return Excel::download(new GuruExport, 'Data Guru.xlsx');
    }

    public function upload(Request $request)
    {
        Excel::import(new GuruImport, $request->data_guru);
        return redirect()->route('admin.listguru')->with('success', 'Data berhasil di upload');
    }
}
