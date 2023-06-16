<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use App\Models\Tugas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use PDF;

class TugasController extends Controller
{
    public function index($id)
    {
        $tugass = Tugas::where('id_bab', $id)->get();
        $moduls = Modul::where('id_bab', $id)->get();
        return view('guru.tugas.index', compact('tugass', 'moduls', 'id'));
    }

    public function create($id)
    {
        return view('guru.tugas.tugas', compact('id'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'desc' => 'required',
            'dir_tugas' => 'required|file|mimes:pdf|max:2048',
        ]);

        // dd($request);

        if ($request->file('dir_tugas')) {
            $file_dokumen = $request->file('dir_tugas')->getClientOriginalName();
            $filename_dokumen = pathinfo($file_dokumen, PATHINFO_FILENAME);
            $ext_dokumen = $request->file('dir_tugas')->getClientOriginalExtension();
            $filename_dokumen = time() . '.' . $filename_dokumen . '.' . $ext_dokumen;
            $file = $request->file('dir_tugas')->storeAs('public/modul', $filename_dokumen);
        }

        $tugas = Tugas::create([
            'id_bab' => $id,
            'desc' => $request->desc,
            'dir_tugas' => $file,
            'deadline' => $request->deadline,
        ]);

        return redirect()->route('guru.tugas', compact('id'))->with('success', 'Data Berhasil Ditambahkan');
    }

    public function getPdf($id1)
    {
        $pdf = Tugas::find($id1);
        return response($pdf->dir_modul)->header('Content-Type', 'application/pdf');
    }

    public function indexSiswa($id)
    {
        // $tugass = Tugas::with('jawaban')->where(['id_bab' => $id]);
        // $moduls = Modul::where('id_bab', $id)->get();

        $tugass = Tugas::where(['id_bab' => $id])->get();
        $moduls = Modul::where(['id_bab' => $id])->get();
        $siswas = Siswa::where(['nis' => Auth::user()->id])->get();

        return view('siswa.tugas.index', compact('tugass', 'moduls', 'siswas', 'id'));
    }
}
