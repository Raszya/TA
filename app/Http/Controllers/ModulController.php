<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use Illuminate\Http\Request;

class ModulController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('guru.tugas.modul', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        $request->validate([
            'desc' => 'required',
            'dir_modul' => 'required|file|mimes:pdf|max:2048',
        ]);

        if ($request->file('dir_modul')) {
            $file_dokumen = $request->file('dir_modul')->getClientOriginalName();
            $filename_dokumen = pathinfo($file_dokumen, PATHINFO_FILENAME);
            $ext_dokumen = $request->file('dir_modul')->getClientOriginalExtension();
            $filename_dokumen = time() . '.' . $filename_dokumen . '.' . $ext_dokumen;
            $file = $request->file('dir_modul')->storeAs('public/modul', $filename_dokumen);
        }
        // dd($request, $file);
        $modul = Modul::create([
            'id_bab' => $id,
            'desc' => $request->desc,
            'dir_modul' => $file,
        ]);

        return redirect()->route('guru.tugas', compact('id'))->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
