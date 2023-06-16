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
use App\Models\Trxjawaban;
use App\Models\Tugas;
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
        // $mapel = Mapel::with(['bab', 'bab.tugas'])->get();
        // $jawaban = Jawaban::with(['tugas', 'tugas.bab', 'tugas.bab.mapel'])->get();
        // dd($request, $id);
        $id1 = Auth::user()->id;
        $request->validate([
            'dir_jawaban' => 'required',
        ]);

        if ($request->file('dir_jawaban')) {
            $file_dokumen = $request->file('dir_jawaban')->getClientOriginalName();
            $filename_dokumen = pathinfo($file_dokumen, PATHINFO_FILENAME);
            $ext_dokumen = $request->file('dir_jawaban')->getClientOriginalExtension();
            $filename_dokumen = time() . '.' . $file_dokumen . '.' . $ext_dokumen;
            $file = $request->file('dir_jawaban')->storeAs('public/modul', $filename_dokumen);
        }

        DB::beginTransaction();

        $jawaban = Jawaban::create([

            'id_tugas' => $id,
            'id_user' => $id1,
            'dir_jawaban' => $file,
        ]);

        $trx_jawaban = Trxjawaban::create([
            'id_user' => $id1,
            'id_tugas' => $id,
            'id_jawaban' => $jawaban->id,
        ]);

        DB::commit();

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
        // $mapel = Mapel::with(['bab', 'bab.tugas', 'bab.tugas.jawaban'])->get();
        $jawaban = Jawaban::with(['user', 'tugas', 'nilai'])->get();
        // dd($jawaban);


        return view('guru.penilaian.index', compact('jawaban'));
    }

    public function storeNilai(Request $request, $id)
    {
        dd($request, $id);
        $request->validate([
            'nilai' => 'required',
        ]);

        $nilai = Nilai::create([
            'id_jawaban' => $id,
            'nilai' => $request->nilai,
        ]);

        return redirect()->back()->with('success', 'Nilai Sudah Terinput');
    }

    public function nilai()
    {
        // $nilai = Nilai::with(['jawaban', 'jawaban.user', 'jawaban.tugas', 'jawaban.tugas.bab', 'jawaban.tugas.bab.mapel'])->get();
        $nilai  = Mapel::with(['bab', 'bab.tugas', 'bab.tugas.jawaban', 'bab.tugas.jawaban.user', 'bab.tugas.jawaban.nilai'])->get();
        // dd($nilai[0]->bab);

        return view('siswa.nilai.nilai', compact('nilai'));
    }
}
