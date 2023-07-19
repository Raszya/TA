<?php

namespace App\Http\Controllers;

use Error;
use App\Models\Bab;
use App\Models\Mapel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User_Mapel;
use Illuminate\Support\Facades\Auth;

class BabController extends Controller
{
    public function index($id)
    {
        $babs = Bab::where('id_mapel', $id)->get();
        $mapel = Mapel::where('id_mapel', $id)->first();
        return view('guru.bab.index', compact('babs', 'mapel'));
    }

    public function create($id)
    {
        return view('guru.bab.create', compact('id'));
    }

    public function store(Request $request, $id)
    {
        // dd($request, $id);
        try {
            Bab::create([
                'id_mapel' => $id,
                'nama' => $request->nama,
                'desc' => $request->desc,
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', 'Data Tidak Sesuai!');
        }
        return redirect()->route('guru.bab', ['id' => $id])->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $babs = Bab::where(['id' => $id])->first();
        return view('guru.bab.edit', [
            'babs' => $babs
        ]);
    }

    public function update(Request $request, $id)
    {
        $bab = Bab::where(['id' => $id]);
        try {
            $bab->update([
                'nama' => $request->nama,
                'desc' => $request->desc,
            ]);
        } catch (\Throwable $th) {
            throw new Error($th);
            return redirect()->back();
        }
        return redirect()->route('guru.bab', ['id' => $id])->with('success', 'Data Berhasil Diedit');
    }

    public function destroy($id)
    {
        $bab = Bab::where(['id' => $id]);
        $bab->delete();
        return redirect()->back()->with('success', 'Data Telah Terhapus!!');
    }

    public function indexSiswa($id)
    {
        // $babs = Bab::where('id_mapel', $id)->get();
        $babs = User_Mapel::with('mapels.bab.tugas.jawaban.nilai')->where('id_siswa', Auth::user()->id)->get();
        return view('siswa.bab.index', compact('babs', 'id'));
    }
}
