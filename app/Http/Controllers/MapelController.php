<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class MapelController extends Controller
{
    public function index(Request $request)
    {
        // $mapels = Mapel::get();
        // return view('admin.mapel.index', compact('mapels'));
        // dd($data);
        if ($request->ajax()) {
            $data = Mapel::with('users')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<div class="btn-group d-flex">';
                    $btn = $btn . '<a href="' . route('admin.siswa.edit', $row->id_mapel) . '" class="btn icon btn-sm btn-warning mx-2" ><i class="bi bi-pencil-fill"></i></a>';
                    $btn = $btn . '<a class="btn icon btn-sm btn-danger deletesiswa" hr><i class="bi bi-trash-fill"></i></a>';
                    $btn = $btn . '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.mapel.index');
    }
}
