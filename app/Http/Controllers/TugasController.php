<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use App\Models\Tugas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class TugasController extends Controller
{
    public function index($id)
    {
        $id = Crypt::decrypt($id);
        $tugass = Tugas::where('id_bab', $id)->get();
        $moduls = Modul::where('id_bab', $id)->get();
        return view('guru.tugas.index', compact('tugass', 'moduls', 'id'));
    }
}
