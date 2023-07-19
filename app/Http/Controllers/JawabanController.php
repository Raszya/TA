<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Jawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\Tahun;
use App\Models\Trxjawaban;
use App\Models\Tugas;
use App\Models\User_Mapel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class JawabanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $id1 = Auth::user()->id;
        $request->validate([
            'dir_jawaban' => 'required',
        ]);

        //mendapatkan data tugas berdasarkan $id_tugas
        $tugas = Tugas::findOrFail($request->id_tugas);

        //memeriksa apakah batas waktu pengumpulan tugas telah lewat
        $deadlinedb = $tugas->deadline;
        $deadline = Carbon::parse($deadlinedb);
        $waktuSekarang = Carbon::now();

        //Mengembalikan ke halaman tugas dengan error karena sudah melebihi deadline
        if ($deadline->lt($waktuSekarang)) {
            return redirect()->route('siswa.tugas', compact('id'))->withErrors('tidak dapat mengirim jawaban karena melebihi batas waktu');
        }

        if ($request->file('dir_jawaban')) {
            $file_dokumen = $request->file('dir_jawaban')->getClientOriginalName();
            $filename_dokumen = pathinfo($file_dokumen, PATHINFO_FILENAME);
            $ext_dokumen = $request->file('dir_jawaban')->getClientOriginalExtension();
            $filename_dokumen = time() . '.' . $file_dokumen . '.' . $ext_dokumen;
            $file = $request->file('dir_jawaban')->storeAs('public/modul', $filename_dokumen);
        }

        $jawaban = Jawaban::create([

            'id_tugas' => $request->id_tugas,
            'id_user' => $id1,
            'dir_jawaban' => $file,
        ]);


        return redirect()->route('siswa.tugas', compact('id'))->with('success', 'Jawaban Telah Terupload');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 
    }

    public function penilaian($id)
    {
        $tugas = Jawaban::with('user', 'nilai')->where('id_tugas', $id)->get();
        return view('guru.penilaian.index', compact('tugas'));
    }

    public function storeNilai(Request $request, $id)
    {
        $request->validate([
            'nilai' => 'required',
        ]);

        $nilai = Nilai::create([
            'id_jawaban' => $id,
            'nilai' => $request->nilai,
        ]);

        return redirect()->back()->with('success', 'Nilai Sudah Terinput');
    }

    public function updatenilai(Request $request, $id)
    {
        $request->validate([
            'nilai' => 'required',
        ]);

        $nilai = Nilai::where('id_jawaban', $id);
        $nilai->update([
            'nilai' => $request->nilai,
        ]);

        return redirect()->back()->with('success', 'Nilai Sudah Terupdate');
    }

    public function nilai()
    {
        $nilai  = User_Mapel::with('mapels.bab.tugas.jawaban.nilai')->where('id_siswa', Auth::user()->id)->get();
        $tahun = Tahun::get();
        return view('siswa.nilai.nilai', compact('nilai', 'tahun'));
    }

    public function nilaiTahun($id)
    {
        $nilai  = User_Mapel::with('mapels.bab.tugas.jawaban.nilai')
            ->where('id_siswa', Auth::user()->id)
            ->where('id_tahun', $id)
            ->get();
        $tahun = Tahun::get();
        return view('siswa.nilai.nilai', compact('nilai', 'tahun', 'id'));
    }
}
