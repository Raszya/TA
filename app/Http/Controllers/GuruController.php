<?php

namespace App\Http\Controllers;

use Error;
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

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        // dd($request);
        try {
            Guru::create([
                'nomer_induk' => $request->nip,
                'nama' => $request->nama,
                'jk' => $request->jenisKelamin,
                'notelp' => $request->noTelp,
                'alamat' => $request->alamat,
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', 'Data Tidak Sesuai!');
        }
        return redirect()->route('admin.listguru')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($nomer_induk)
    {
        $guru = Guru::where(['nomer_induk' => $nomer_induk])->first();
        return view('admin.guru.edit', [
            'guru' => $guru
        ]);
    }

    public function update(Request $request, $nomer_induk)
    {
        $guru = Guru::where(['nomer_induk' => $nomer_induk]);
        try {
            $guru->update([
                'nama' => $request->nama,
                'jk' => $request->jenisKelamin,
                'notelp' => $request->noTelp,
                'alamat' => $request->alamat,
            ]);
        } catch (\Throwable $th) {
            throw new Error($th);
            return redirect()->back();
        }
        return redirect()->route('admin.listguru')->with('success', 'Data Berhasil Diedit');
    }

    public function destroy($nomer_induk)
    {
        $guru = Guru::where(['nomer_induk' => $nomer_induk]);
        $guru->delete();
        return redirect()->route('admin.listguru')->with('success', 'Data Berhasil Dihapus');
    }
}
