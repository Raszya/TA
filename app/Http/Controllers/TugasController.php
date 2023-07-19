<?php

namespace App\Http\Controllers;

use App\Events\TugasBaru;
use App\Models\Modul;
use App\Models\Tugas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bab;
use App\Models\Siswa;
use App\Models\User;
use App\Models\User_Mapel;
use App\Notifications\TugasNotif;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use PDF;

class TugasController extends Controller
{
    public function index($id)
    {
        // Menampilkan Halaman List modeul dan tugas
        $tugass = Tugas::with('jawaban')->where('id_bab', $id)->get();
        $moduls = Modul::where('id_bab', $id)->get();
        // dd($tugass);
        return view('guru.tugas.index', compact('tugass', 'moduls', 'id'));
    }

    public function create($id)
    {
        return view('guru.tugas.tugas', compact('id'));
    }

    public function store(Request $request, $id)
    {
        // insert into database
        $request->validate([
            'jenisTugas' => 'required|in:1,2',
            'desc' => 'required',
            'dir_tugas' => 'required|file|mimes:pdf|max:2048',
        ]);

        $jenisTugas = $request->input('jenisTugas');
        $deadline = $request->input('deadline');

        // untuk menyimpan file upload 
        if ($request->file('dir_tugas')) {
            $file_dokumen = $request->file('dir_tugas')->getClientOriginalName();
            $filename_dokumen = pathinfo($file_dokumen, PATHINFO_FILENAME);
            $ext_dokumen = $request->file('dir_tugas')->getClientOriginalExtension();
            $filename_dokumen = time() . '.' . $filename_dokumen . '.' . $ext_dokumen;
            $file = $request->file('dir_tugas')->storeAs('public/modul', $filename_dokumen);
        }


        $tugas = Tugas::create([
            'id_bab' => $id,
            'desc' => $request->desc,
            'dir_tugas' => $file,
            'deadline' => $deadline,
            'jenisTugas' => $jenisTugas,
        ]);

        //mengambil data yang baru saya di tambahkan
        $namatugas = $tugas->desc;
        $id_bab = $tugas->id_bab;
        $deadline = $tugas->deadline;

        //Mengambil data mapel
        $bab = Bab::find($id_bab);
        $id_mapel = $bab->id_mapel;

        //mengambil data user sesuai dengan mapel
        $mapel = User_Mapel::where('id_mapel', $id_mapel)->get();
        $users = User::whereIn('id', $mapel->pluck('id_siswa'))->get();

        foreach ($users as $user) {

            $user->notify(new TugasNotif($namatugas, $id_bab, $id_mapel, $deadline));
        }
        // $id_tugas = $tugas->id;
        // event(new TugasBaru($id_tugas));

        return redirect()->route('guru.tugas', compact('id'))->with('success', 'Data Berhasil Ditambahkan');
    }

    public function getPdf($id1)
    {
        $pdf = Tugas::find($id1);
        return response($pdf->dir_modul)->header('Content-Type', 'application/pdf');
    }

    public function indexSiswa($id)
    {

        $tugass = Tugas::where(['id_bab' => $id])->get();
        $moduls = Modul::where(['id_bab' => $id])->get();
        $siswas = Siswa::where(['nis' => Auth::user()->id])->get();

        return view('siswa.tugas.index', compact('tugass', 'moduls', 'siswas', 'id'));
    }
}
