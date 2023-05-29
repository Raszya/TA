@extends('new-layouts.app')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Mapel</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('guru.mapel') }}">List Siswa</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    {{-- body --}}
    {{-- <div class="container"> --}}
    {{-- <div class="card">
            <div class="card-body"> --}}
    <div class="row">
        @if (!@empty($mapels))
            @forelse($mapels as $mapel)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $mapel->nama }}</h5>
                            <p class="card-text">{{ $mapel->desc }}</p>
                            <a href="#" class="btn btn-warning">edit</a>
                            <a href="#" class="btn btn-primary">detail</a>
                        </div>
                    </div>
                </div>
            @empty
                <h3 class="alert alert-info text-center">Belum ada mata pelajaran</h3>
            @endforelse
        @endif
    </div>
    {{-- </div>
        </div> --}}
    {{-- </div> --}}
@endsection
