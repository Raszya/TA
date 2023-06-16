@extends('new-layouts.app')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Bab</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                {{-- <a href="{{ route('guru.bab', ['id' => $id]) }}">List Bab</a> --}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped" id="tabel1">
            <thead>
                <tr>
                    <th class="w-10px text-center">No</th>
                    <th class="w-200px text-center">Nis</th>
                    <th class="w-200px text-center">Nama Siswa</th>
                    <th class="w-200px text-center">Jawaban</th>
                    <th class="w-px text-center">Nilai</th>
                    <th class="w-20px text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if (!@empty($jawaban))
                    @forelse ($jawaban as $row)
                        <tr>
                            <td class="align-top text-center"> {{ $loop->iteration }}</td>
                            <td class="align-top">
                                {{ $row->user->nis }}
                            </td>
                            <td class="align-top">
                                {{ $row->user->name }}
                            </td>
                            <td class="align-top text-center">
                                <a href="{{ Storage::url($row->dir_jawaban) }}" class="btn btn-danger"><i
                                        class="bi bi-file-pdf-fill"></i></a>
                            </td>
                            <td class="align-top">
                                <form action="{{ route('guru.penilaian.store', ['id' => $row->id]) }}" class="d-flex"
                                    method="POST">
                                    @csrf
                                    <input type="text" id="nilai" class="form-control-sm" name="nilai"
                                        placeholder="nilai" required autocomplete="off"
                                        value="{{ $row->nilai->nilai ? $row->nilai->nilai : '' }}">
                                    <button class="btn btn-primary mx-2" type="submit">Submit</button>
                                </form>
                            </td>
                            <td class="text-center d-flex gap-1 justify-content-center in-line align-top"
                                data-kt-menu="true">
                                <form method="GET" action="">
                                    <button class="btn icon btn-sm btn btn-warning"> <i
                                            class="bi bi-pencil-square"></i></button>
                                </form>
                                <form action="" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn icon btn-sm btn-danger" onclick="return confirm('Are you sure?')"
                                        title="Hapus User?">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </form>
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
@endsection
