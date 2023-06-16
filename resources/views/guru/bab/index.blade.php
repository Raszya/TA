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

    {{-- @dd($mapel->id_mapel); --}}
    <a href="{{ route('guru.bab.create', ['id' => $mapel->id_mapel]) }}" class="btn btn-info my-3">Tambah
        Bab</a>
    @if (!@empty($babs))
        @forelse($babs as $bab)
            <div class="card">
                <div class="card-header">
                    Bab {{ $loop->iteration }}
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $bab->nama }}</h5>
                    <p class="card-text">{{ $bab->desc }}</p>
                    <a href="{{ route('guru.tugas', ['id' => $bab->id]) }}" class="btn btn-success">Detail</a>
                    <a href="{{ route('guru.bab.edit', ['id' => $bab->id]) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('guru.bab.destroy', $bab->id) }}" method="POST" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn icon btn-sm btn-danger" onclick="return confirm('Are you sure?')"
                            title="Hapus User?">Delete</button>

                    </form>
                </div>
            </div>
        @empty
            <h3 class="alert alert-info text-center">Belum ada mata pelajaran</h3>
        @endforelse
    @endif
@endsection
