<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        // $roles = Role::all();``````````````````````````````````````````````````````````````````````````````````````````
        // $users = DB::table('users as x')->select("x.name as name_user", "x.email as email_user", "z.name as role_name", "x.id as id_user")
        //     ->join('model_has_roles as y', 'y.model_id', '=', 'x.id')
        //     ->join('roles as z', 'z.id', '=', 'y.role_id')
        //     ->get();
        // // dd($users);
        return view('admin.users.index', compact('users'));
        // $data = User::get();
        // dd($data);

        // if ($request->ajax()) {
        //     $data = User::get();
        //     return DataTables::of($data)
        //         ->addIndexColumn()
        //         ->addColumn('action', function ($row) {

        //             $btn = '<div class="btn-group d-flex">';
        //             $btn = $btn . '<a href="' . route('admin.siswa.edit', $row->id) . '" class="btn icon btn-sm btn-warning mx-2" ><i class="bi bi-pencil-fill"></i></a>';
        //             $btn = $btn . '<a class="btn icon btn-sm btn-danger deletesiswa" hr><i class="bi bi-trash-fill"></i></a>';
        //             $btn = $btn . '</div>';
        //             return $btn;
        //         })
        //         ->rawColumns(['action'])
        //         ->make(true);
        // }
        return view('admin.users.index');
    }
}
