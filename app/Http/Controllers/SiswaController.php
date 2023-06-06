<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Jurusan;
use App\Exports\SiswaExport;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Error;
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

    public function create()
    {
        $jurusans = Jurusan::get();
        return view('admin.siswa.create', [
            'jurusans' => $jurusans
        ]);
    }

    public function store(Request $request)
    {

        try {
            Siswa::create([
                'nis' => $request->nis,
                'nama' => $request->nama,
                'jk' => $request->jenisKelamin,
                'id_jurusan' => $request->jurusan,
                'notelp' => $request->noTelp,
                'alamat' => $request->alamat,
            ]);
        } catch (\Throwable $th) {
            return redirect()->back();
        }
        return redirect(route('admin.listsiswa'))->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($nis)
    {
        $siswa = Siswa::where(['nis' => $nis])->first();
        $jurusans = Jurusan::get();
        return view('admin.siswa.edit', [
            'jurusans' => $jurusans,
            'siswa' => $siswa
        ]);
    }

    public function update(Request $request, $nis)
    {
        $siswa = Siswa::where(['nis' => $nis]);
        // dd($siswa, $request);
        try {
            $siswa->update([
                'nama' => $request->nama,
                'notelp' => $request->noTelp,
                'jk' => $request->jenisKelamin,
                'id_jurusan' => $request->jurusan,
                'alamat' => $request->alamat
            ]);
        } catch (\Throwable $th) {
            throw new Error($th);
            return redirect()->back();
        }
        return redirect()->route('admin.listsiswa')->with('success', 'Data Berhasil Diedit');
    }

    public function destroy($nis)
    {
        $siswa = Siswa::where(['nis' => $nis]);
        $siswa->delete();
        return redirect()->route('admin.listsiswa')->with('success', 'Data Telah Terhapus!!');
    }
}
