<?php

namespace App\Http\Controllers;

use Error;
use App\Models\Guru;
use App\Exports\GuruExport;
use App\Imports\GuruImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        // $gurus = Guru::get();
        // return view('admin.guru.listguru', compact('gurus'));

        // dd($data);

        if ($request->ajax()) {
            $data = Guru::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<div class="btn-group d-flex">';
                    $btn = $btn . '<a href="' . route('admin.guru.edit', $row->nomer_induk) . '" class="btn icon btn-sm btn-warning mx-2" ><i class="bi bi-pencil-fill"></i></a>';
                    $btn = $btn . '<a class="btn icon btn-sm btn-danger deleteguru" data-nomer_induk=' . $row->nomer_induk . '><i class="bi bi-trash-fill"></i></a>';
                    $btn = $btn . '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.guru.listguru');
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

    public function destroy(Request $request)
    {
        $guru = Guru::where(['nomer_induk' => $request->nomer_induk]);
        $guru->delete();
        return 'Data telah dihapus';
    }
}
