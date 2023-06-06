<?php

namespace App\Http\Controllers;

use Error;
use App\Models\User;
use App\Models\Mapel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MapelGuruController extends Controller
{
    public function index()
    {
        // $mapels = Mapel::get();
        // return view('guru.mapel.index', compact('mapels'));
        $data = User::find(Auth::user()->id);
        $id_user = $data->id;

        return view('guru.mapel.index', [
            'mapels' => Mapel::where('id_user', $id_user)->latest()->get()
        ]);
    }

    public function create()
    {
        return view('guru.mapel.create');
    }

    public function store(Request $request)
    {
        $data = User::find(Auth::user()->id);
        $id_user = $data->id;
        // dd($request, $id_user);

        try {
            Mapel::create([
                'nama' => $request->nama,
                'kode_akses' => $request->kode_akses,
                'id_user' => $id_user,
                'desc' => $request->desc,
                'status' => '1'
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', 'Data Tidak Sesuai!');
        }
        return redirect()->route('guru.mapel')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($id_mapel)
    {
        $mapel = Mapel::where(['id_mapel' => $id_mapel])->first();
        return view('guru.mapel.edit', [
            'mapel' => $mapel
        ]);
    }

    public function update(Request $request, $id_mapel)
    {
        $mapel = Mapel::where(['id_mapel' => $id_mapel]);
        try {
            $mapel->update([
                'nama' => $request->nama,
                'kode_akses' => $request->kode_akses,
                'desc' => $request->desc,
            ]);
        } catch (\Throwable $th) {
            throw new Error($th);
            return redirect()->back();
        }
        return redirect()->route('guru.mapel')->with('success', 'Data Berhasil Diedit');
    }
}
