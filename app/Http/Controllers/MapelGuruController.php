<?php

namespace App\Http\Controllers;

use Error;
use App\Models\User;
use App\Models\Mapel;
use Illuminate\Http\Request;
use App\Models\Trx_mapel_guru;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class MapelGuruController extends Controller
{
    public function index()
    {
        // Menampilkan data mapel berdasarkan tabel Trx_mapel_guru
        $data = User::find(Auth::user()->id);
        $id_user = $data->nip;

        $Trx_guru = Trx_mapel_guru::with(['mapel', 'guru'])->where('nip', $id_user)->get();
        return view('guru.mapel.index', compact('Trx_guru'));
    }

    public function create()
    {
        return view('guru.mapel.create');
    }

    public function store(Request $request)
    {
        $data = User::find(Auth::user()->id);
        $id_user = $data->id;

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

    public function edit($id)
    {
        $mapel = Trx_mapel_guru::with(['mapel', 'guru'])->where(['id' => $id])->first();
        return view('guru.mapel.edit', [
            'mapel' => $mapel
        ]);
    }

    public function update(Request $request, $id)
    {
        $mapel = Trx_mapel_guru::where(['id' => $id]);
        // dd($request, $mapel);
        try {
            $mapel->update([
                'kode_akses' => $request->kode_akses,
                'desc' => $request->desc,
            ]);
        } catch (\Throwable $th) {
            throw new Error($th);
            return redirect()->back();
        }
        return redirect()->route('guru.mapel')->with('success', 'Data Berhasil Diedit');
    }

    public function history(Request $request)
    {
        // Mengambil data mapel berdasarkan nip guru
        $data = User::find(Auth::user()->id);
        $id_user = $data->nip;

        if ($request->ajax()) {
            $data = Trx_mapel_guru::with(['mapel', 'guru'])->withTrashed()->where('nip', $id_user)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<div class="btn-group d-flex">';
                    $btn = $btn . '<a href="' . route('guru.mapel.edit', $row->id) . '" class="btn icon btn-sm btn-warning mx-2" title="Edit Guru" ><i class="bi bi-pencil-fill"></i></a>';
                    // Membuat button menjadi 2 case ya itu case jika is_aktif = '0' maka yang muncul button restore, satu lagi case jika is_aktif = '1' maka yang muncul button delete
                    switch ($row->is_aktif) {
                        case '0':
                            $btn = $btn . '<a class="btn icon btn-sm btn-success restoremapel" data-id=' . $row->id . ' title="Pulihkan Mapel?" hr><i class="bi bi-recycle"></i></a>';
                            break;
                        case '1':
                            $btn = $btn . '<a class="btn icon btn-sm btn-success disabled" data-id=' . $row->id . ' title="Pulihkan Mapel?" hr><i class="bi bi-recycle"></i></a>';
                            break;
                    }
                    $btn = $btn . '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('guru.mapel.history');
    }

    public function destroy($id)
    {
        $mapel = Trx_mapel_guru::findOrFail($id);
        $mapel->is_aktif = '0'; // Ubah nilai kolom is_aktif menjadi 0
        $mapel->save(); // Simpan perubahan
        $mapel->delete();
        return redirect()->route('guru.mapel')->with('success', 'Mata Pelajaran Sudah Selesai');
    }

    public function restore(Request $request)
    {
        $mapel = Trx_mapel_guru::withTrashed()->where('id', $request->id);
        $mapel->update([
            'is_aktif' => '1'
        ]);
        $mapel->restore();
        return redirect()->route('guru.mapel.history')->with('success', 'Mata Pelajaran dipulihkan');
    }
}
