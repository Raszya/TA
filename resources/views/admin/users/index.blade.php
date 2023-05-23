@extends('new-layouts.app')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>User Management</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/user">User Management</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <div>
                    <a class="btn btn-primary btn-sm" href="/user/create">
                        <i class="bi bi-plus-lg"></i>
                        Tambah User
                    </a>
                </div>
                <br>
                <div class="table-responsive">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th class="w-10px text-center">No</th>
                                <th class="w-200px text-center">Nama</th>
                                <th class="w-200px text-center">Email</th>
                                <th class="w-200px text-center">Role</th>
                                <th class="w-20px text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!@empty($users))
                                @forelse ($users as $user)
                                    <tr>
                                        <td class="align-top text-center"> {{ $loop->iteration }}</td>
                                        <td class="align-top">
                                            {{ $user->name_user }}
                                        </td>
                                        <td class="align-top">
                                            {{ $user->email_user }}
                                        </td>
                                        <td class="align-top">
                                            {{ $user->role_name }}
                                        </td>
                                        <td class="text-center justify-content-center in-line align-top"
                                            data-kt-menu="true">
                                            {{-- <form method="GET" action="{{ route('SUadmin.users.show', $user->id_user) }}">
                                                <button class="btn btn-bg-primary btn-sm px-4 text-white">Edit</button>
                                            </form>
                                            <form action="{{ route('SUadmin.users.destroy', $user->id_user) }}"
                                                method="POST" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn icon btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure?')" title="Hapus User?">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <strong>Belum Ada Data</strong>
                                        </td>
                                    </tr>
                                @endforelse
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
