<?php

namespace App\Http\Controllers;

use Error;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Exports\SiswaExport;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Mapel;
use App\Models\User_Mapel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;


class SiswaController extends Controller
{
    public function getListMapel()
    {
        $id = Auth::user()->id;
        $data = User_Mapel::with('mapels')->where(['id_siswa' => $id])->get();
        return response()->json($data);
    }

    public function index(Request $request)
    {
        // $siswas = Siswa::get();
        // return view('admin.siswa.listsiswa', compact('siswas'));

        if ($request->ajax()) {
            $data = Siswa::with('jurusan')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<div class="btn-group d-flex">';
                    $btn = $btn . '<a href="' . route('admin.siswa.edit', $row->nis) . '" class="btn icon btn-sm btn-warning mx-2" ><i class="bi bi-pencil-fill"></i></a>';
                    $btn = $btn . '<a class="btn icon btn-sm btn-danger deletesiswa"data-nis=' . $row->nis . '><i class="bi bi-trash-fill" ></i></a>';
                    $btn = $btn . '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.siswa.listsiswa');
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

    public function destroy(Request $request)
    {
        $siswa = Siswa::where(['nis' => $request->nis]);
        $siswa->delete();
        return 'Data telah dihapus';

        // [, $id] = $request;
        // return $request->nis;
        // if (Siswa::where('nis', $id)->delete()) {
        //     $response['success'] = 1;
        //     $response['msg'] = 'Delete successfully';
        // } else {
        //     $response['success'] = 0;
        //     $response['msg'] = 'Invalid ID.';
        // }

        // return response()->json($response);
    }

    public function enrollment($id)
    {
        $mapel = Mapel::where('id_mapel', $id)->first();

        return view('siswa.enrollment', compact('mapel'));
    }

    public function enrollmentstore(Request $request, $id)
    {
        $request->validate([
            'kode_akses' => ['required'],
        ]);

        $mapel = Mapel::where('id_mapel', $id)->first();
        if ($request->kode_akses == $mapel->kode_akses) {
            $hasData =  User_Mapel::where(['id_mapel' => $mapel->id_mapel, 'id_siswa' => Auth::user()->id])->first();
            // dd($hasData);
            if ($hasData) {
                return redirect()->route('dashboard')->with('error', 'Mata Pelajaran Sudah diambil');
            }
            $trx_mapel = User_Mapel::create([
                'id_mapel' => $id,
                'id_siswa' => Auth::user()->id,
            ]);

            return redirect()->route('dashboard')->with('success', 'Berhasil mengambil mata pelajaran');
        } else {
            return redirect()->back()->with('error', 'Kode Akses Salah');
        }
    }
}
