<?php

namespace App\Http\Controllers;

use App\Models\Bab;
use App\Models\Mapel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class BabController extends Controller
{
    public function index($id)
    {
        $babs = Bab::where('id_mapel', $id)->get();
        // dd($babs);
        $mapel = Mapel::where('id_mapel', $id)->first();
        // dd($id);
        return view('guru.bab.index', compact('babs', 'mapel'));
    }

    public function create($id)
    {
        $id = Crypt::decrypt($id);
        // dd($id);
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
}
