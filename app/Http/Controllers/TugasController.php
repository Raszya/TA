<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use App\Models\Tugas;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index()
    {
        $tugass = Tugas::get();
        $moduls = Modul::get();
        return view('guru.tugas.index', compact('tugass', 'moduls'));
    }
}
