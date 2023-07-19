<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Trx_mapel_guru;
use App\Models\Tugas;
use App\Models\User_Mapel;
use Yajra\DataTables\Facades\DataTables;

class MapelController extends Controller
{
    public function index(Request $request)
    {
        // Menampilkan data berdasarkan request Ajax
        if ($request->ajax()) {
            $data = Mapel::withTrashed()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<div class="btn-group d-flex">';
                    switch ($row->is_aktif) {
                        case '0':
                            $btn = $btn . '<a href="' . route('admin.mapel.assign', $row->id_mapel) . '" class="btn icon btn-sm btn-primary disabled" title="Assign Guru"><i class="bi bi-box-arrow-in-right"></i></a>';
                            break;
                        case '1':
                            $btn = $btn . '<a href="' . route('admin.mapel.assign', $row->id_mapel) . '" class="btn icon btn-sm btn-primary" title="Assign Guru"><i class="bi bi-box-arrow-in-right"></i></a>';
                    }
                    $btn = $btn . '<a href="' . route('admin.siswa.edit', $row->id_mapel) . '" class="btn icon btn-sm btn-warning mx-2" title="Edit Guru" ><i class="bi bi-pencil-fill"></i></a>';
                    switch ($row->is_aktif) {
                        case '0':
                            $btn = $btn . '<a class="btn icon btn-sm btn-success restoremapel" data-id_mapel=' . $row->id_mapel . ' title="Pulihkan Mapel?" hr><i class="bi bi-recycle"></i></a>';
                            break;
                        case '1':
                            $btn = $btn . '<a class="btn icon btn-sm btn-danger deletemapel" data-id_mapel=' . $row->id_mapel . ' title="Hapus Mapel?" hr><i class="bi bi-trash-fill"></i></a>';
                            break;
                    }
                    $btn = $btn . '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.mapel.index');
    }

    public function create()
    {
        // Menampilkan view tambah Mapel
        $mapels = Mapel::all();
        return view('admin.mapel.create', compact('mapels'));
    }

    public function store(Request $request)
    {
        // Insert to database
        $request->validate([
            'id' => 'required',
            'nama' => 'required|max:255',
        ]);

        $mapels = Mapel::create([
            'id_mapel' => $request->id,
            'nama' => $request->nama,
            'is_aktif' => '1',
        ]);
        return redirect()->route('admin.mapel')->with('success', 'Mapel Berhasil ditambahkan');
    }

    public function destroy(Request $request)
    {
        $mapel = Mapel::findOrFail($request->id_mapel);
        $mapel->is_aktif = '0'; // Ubah nilai kolom is_aktif menjadi 0
        $mapel->save(); // Simpan perubahan
        $mapel->delete();
        return 'Data telah dihapus';
    }

    public function restore(Request $request)
    {
        $mapel = Mapel::withTrashed()->findOrFail($request->id_mapel);
        $mapel->is_aktif = '1';
        $mapel->save();
        $mapel->restore();
        return 'Data telah dipulihkan';
    }

    public function assign($id)
    {
        // Menampilkan View Assign Guru
        $mapels = Mapel::where(['id_mapel' => $id])->first();
        $gurus = Guru::get();

        // dd($id, $mapels, $gurus);

        return view('admin.mapel.assign', compact('mapels', 'gurus'));
    }

    public function storeAssign(Request $request)
    {
        // Insert to database
        $request->validate([
            'nip' => 'required',
            'id_mapel' => 'required|max:255',
        ]);

        $trxguru = Trx_mapel_guru::create([
            'nip' => $request->nip,
            'id_mapel' => $request->id_mapel,
            'is_aktif' => '1'
        ]);
        return redirect()->route('admin.mapel')->with('success', 'Mapel Berhasil diassign');
    }
}
