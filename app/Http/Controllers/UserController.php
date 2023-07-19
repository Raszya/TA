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
        // Mengambil data user berdasarkan request ajax
        if ($request->ajax()) {

            $data = User::all();


            foreach ($data as $user) {
                $user->roles = $user->roles()->pluck('name')->toArray();
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<div class="btn-group d-flex">';
                    $btn = $btn . '<a href="' . route('admin.users.edit', $row->id) . '" class="btn icon btn-sm btn-warning mx-2" ><i class="bi bi-pencil-fill"></i></a>';
                    $btn = $btn . '<a class="btn icon btn-sm btn-danger deletesiswa" hr><i class="bi bi-trash-fill"></i></a>';
                    $btn = $btn . '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.users.index');
    }

    public function edit(User $user)
    {
        //Menampilan Edit User 
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function assignRole(Request $request, User $user)
    {
        // Assign Role 
        if ($user->hasRole($request->role)) {
            return redirect()->back()->back()->with('error', 'Role already assigned');
        }
        $user->assignRole($request->role);
        return redirect()->back()->with('success', 'Role has been assigned');
    }

    public function removeRole(User $user, Role $role)
    {
        // Remove Role 
        $user->roles()->detach($role);
        return redirect()->back()->with('success', 'Role has been removed');
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return redirect()->back()->with('success', 'Role has been removed');
        }
        return redirect()->back()->with('error', 'Error');
    }
}
