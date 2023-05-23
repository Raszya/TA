@extends('new-layouts.app')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>List Siswa</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.listsiswa') }}">List Siswa</a>
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
                <div class="flash-message">
                    {{-- @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if (Session::has('alert-' . $msg))
                            <p id="alert" class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                            </p>
                        @endif
                    @endforeach --}}
                </div>
                <div>
                    <a class="btn btn-primary btn-sm" href="/user/create">
                        <i class="bi bi-plus-lg"></i>
                        Tambah User
                    </a>
                    <a class="btn btn-success btn-sm" href="{{ route('admin.downloaddataguru') }}" target="_blank">
                        <i class=""></i>
                        Export Excel
                    </a>
                    <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#uploaddata">
                        Upload Excel
                    </button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="uploaddata" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Upload Data Guru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.uploaddataguru') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="data_guru" class="form-control"><br>
                                    <button type="" class="btn btn-primary">Save changes</button>
                                </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="table-responsive">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th class="w-10px text-center">No</th>
                                <th class="w-200px text-center">Nomer Induk</th>
                                <th class="w-200px text-center">Nama</th>
                                {{-- <th class="w-200px text-center">Role</th> --}}
                                <th class="w-200px text-center">Alamat</th>
                                <th class="w-200px text-center">Notelp</th>
                                <th class="w-20px text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!@empty($gurus))
                                @forelse ($gurus as $guru)
                                    <tr>
                                        <td class="align-top text-center"> {{ $loop->iteration }}</td>
                                        <td class="align-top">
                                            {{ $guru->nomer_induk }}
                                        </td>
                                        <td class="align-top">
                                            {{ $guru->nama }}
                                        </td>
                                        <td class="align-top">
                                            {{ $guru->alamat }}
                                        </td>
                                        <td class="align-top">
                                            {{ $guru->notelp }}
                                        </td>
                                        <td class="text-center justify-content-center in-line align-top"
                                            data-kt-menu="true">
                                            <form method="GET" action="">
                                                <button class="btn btn-bg-primary btn-sm px-4 text-white">Edit</button>
                                            </form>
                                            <form action="" method="POST" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn icon btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure?')" title="Hapus User?">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
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
