<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MapelController extends Controller
{
    public function index()
    {
        $mapels = Mapel::get();
        return view('admin.mapel.index', compact('mapels'));
    }
}
