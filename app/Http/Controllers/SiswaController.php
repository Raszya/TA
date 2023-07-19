<?php

namespace App\Http\Controllers;

use Error;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Exports\SiswaExport;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Tahun;
use App\Models\Trx_mapel_guru;
use App\Models\User_Mapel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;



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
        // Untuk Mengambil data dengan request ajax
        if ($request->ajax()) {
            $data = Siswa::with('jurusan', 'kelas', 'tahun')->withTrashed()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<div class="btn-group d-flex">';
                    $btn = $btn . '<a href="' . route('admin.siswa.edit', $row->nis) . '" class="btn icon btn-sm btn-warning mx-2" ><i class="bi bi-pencil-fill"></i></a>';
                    switch ($row->is_aktif) {
                        case '0':
                            $btn = $btn . '<a class="btn icon btn-sm btn-success restoresiswa" data-nis=' . $row->nis . ' title="Pulihkan Siswa?" hr><i class="bi bi-recycle"></i></a>';
                            break;
                        case '1':
                            $btn = $btn . '<a class="btn icon btn-sm btn-danger deletesiswa" data-nis=' . $row->nis . ' title="Hapus Siswa?" hr><i class="bi bi-trash-fill"></i></a>';
                            break;
                    }
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
        // Untuk Menampilkan View Tambah Siswa
        $jurusans = Jurusan::get();
        $kelas = Kelas::get();
        $tahun = Tahun::get();
        return view('admin.siswa.create', [
            'jurusans' => $jurusans,
            'kelas' => $kelas,
            'tahun' => $tahun,
        ]);
    }

    public function store(Request $request)
    {
        // Untuk Memasukan data inputan kedalam database
        try {
            Siswa::create([
                'nis' => $request->nis,
                'nama' => $request->nama,
                'jk' => $request->jenisKelamin,
                'id_jurusan' => $request->jurusan,
                'id_kelas' => $request->kelas,
                'id_tahun' => $request->tahun,
                'notelp' => $request->noTelp,
                'alamat' => $request->alamat,
                'is_aktif' => '1',
            ]);
        } catch (\Throwable $th) {
            return redirect()->back();
        }
        return redirect(route('admin.listsiswa'))->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($nis)
    {
        // Untuk Menampilkan Halaman Edit Siswa
        $siswa = Siswa::where(['nis' => $nis])->first();
        $jurusans = Jurusan::get();
        return view('admin.siswa.edit', [
            'jurusans' => $jurusans,
            'siswa' => $siswa
        ]);
    }

    public function update(Request $request, $nis)
    {
        // Untuk Melakukan update database siswa
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
        $siswa = Siswa::where('nis', $request->nis);
        $siswa->update([
            'is_aktif' => '0',
        ]);
        $siswa->delete();
        return 'Data telah dihapus';
    }

    public function restore(Request $request)
    {
        $siswa = Siswa::withTrashed()->where('nis', $request->nis);
        $siswa->update([
            'is_aktif' => '1',
        ]);
        $siswa->restore();
        return 'Data telah direstore';
    }

    public function enrollment($id)
    {
        $mapel = Mapel::where('id_mapel', $id)->first();
        $tahun = Tahun::get();

        return view('siswa.enrollment', compact('mapel', 'tahun'));
    }

    public function enrollmentstore(Request $request, $id)
    {
        $request->validate([
            'kode_akses' => ['required'],
        ]);

        $mapel = Trx_mapel_guru::where('id_mapel', $id)->first();
        if ($request->kode_akses == $mapel->kode_akses) {
            $hasData =  User_Mapel::where(['id_mapel' => $mapel->id_mapel, 'id_siswa' => Auth::user()->id])->first();
            // dd($hasData);
            if ($hasData) {
                return redirect()->route('dashboard')->with('error', 'Mata Pelajaran Sudah diambil');
            }

            $tahunsekarang = Carbon::now()->year;
            $tahun = Tahun::where('thn', $tahunsekarang)->first();

            $trx_mapel = User_Mapel::create([
                'id_mapel' => $id,
                'id_siswa' => Auth::user()->id,
                'id_tahun' => $tahun->id,
            ]);

            return redirect()->route('dashboard')->with('success', 'Berhasil mengambil mata pelajaran');
        } else {
            return redirect()->back()->with('error', 'Kode Akses Salah');
        }
    }

    public function kelas(Request $request)
    {
        if ($request->ajax()) {
            $data = Kelas::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<div class="btn-group d-flex">';
                    $btn = $btn . '<a href=" " class="btn icon btn-sm btn-warning mx-2" ><i class="bi bi-pencil-fill"></i></a>';
                    switch ($row->is_aktif) {
                        case '0':
                            $btn = $btn . '<a class="btn icon btn-sm btn-success restoresiswa" data-nis=' . $row->nis . ' title="Pulihkan Siswa?" hr><i class="bi bi-recycle"></i></a>';
                            break;
                        case '1':
                            $btn = $btn . '<a class="btn icon btn-sm btn-danger deletesiswa" data-nis=' . $row->nis . ' title="Hapus Siswa?" hr><i class="bi bi-trash-fill"></i></a>';
                            break;
                    }
                    $btn = $btn . '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.siswa.kelas.index');
    }

    public function createKelas()
    {
        return view('admin.siswa.kelas.create');
    }

    public function storeKelas(Request $request)
    {
        $request->validate([
            'kelas' => 'required',
        ]);

        $kelas = Kelas::create([
            'nama' => $request->kelas,
            'is_aktif' => '1',
        ]);

        return redirect()->route('admin.kelas')->with('success', 'Kelas Berhasil ditambahkan');
    }

    public function deleteKelas(Request $request)
    {
    }

    public function restoreKelas(Request $request)
    {
    }

    public function editKelas($id)
    {
    }

    public function updateKelas(Request $request)
    {
    }

    public function indexTahun(Request $request)
    {
        if ($request->ajax()) {
            $data = Tahun::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<div class="btn-group d-flex">';
                    $btn = $btn . '<a href=" " class="btn icon btn-sm btn-warning mx-2" ><i class="bi bi-pencil-fill"></i></a>';
                    switch ($row->is_aktif) {
                        case '0':
                            $btn = $btn . '<a class="btn icon btn-sm btn-success restoresiswa" data-nis=' . $row->nis . ' title="Pulihkan Siswa?" hr><i class="bi bi-recycle"></i></a>';
                            break;
                        case '1':
                            $btn = $btn . '<a class="btn icon btn-sm btn-danger deletesiswa" data-nis=' . $row->nis . ' title="Hapus Siswa?" hr><i class="bi bi-trash-fill"></i></a>';
                            break;
                    }
                    $btn = $btn . '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.siswa.tahun.index');
    }

    public function createTahun()
    {
        return view('admin.siswa.tahun.create');
    }

    public function storeTahun(Request $request)
    {
        $request->validate([
            'tahun' => 'required',
        ]);

        $tahun4 = $request->tahun;
        $tahun4 = Str::substr($tahun4, 0, 4);

        $tahun = Tahun::create([
            'thn' => $tahun4,
            'tahun' => $request->tahun,
            'is_aktif' => '1',
        ]);

        return redirect()->route('admin.tahunajaran')->with('success', 'Tahun Ajaran Berhasil ditambahkan');
    }

    public function deleteTahun(Request $request)
    {
    }

    public function restoreTahun(Request $request)
    {
    }

    public function editTahun($id)
    {
    }

    public function updateTahun(Request $request)
    {
    }
}
