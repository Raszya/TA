<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        // $users = User::all();
        // $roles = Role::all();
        $users = DB::table('users as x')->select("x.name as name_user", "x.email as email_user", "z.name as role_name", "x.id as id_user")
            ->join('model_has_roles as y', 'y.model_id', '=', 'x.id')
            ->join('roles as z', 'z.id', '=', 'y.role_id')
            ->get();
        // dd($users);
        return view('admin.users.index', compact('users'));
    }
}
