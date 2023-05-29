<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MapelGuruController extends Controller
{
    public function index()
    {
        $mapels = Mapel::get();
        return view('guru.mapel.index', compact('mapels'));
    }
}
