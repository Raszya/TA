@extends('new-layouts.app')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Dashboard</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <h4>Selamat Datang, {{ Auth::user()->name }}</h4>
            </div>
        </div>
        @role('siswa')
            <div class="row">
                @if (!@empty($mapels))
                    @forelse($mapels as $mapel)
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $mapel->nama }}</h5>
                                    <h6 class="card-text">{{ $mapel->desc }}</h6>
                                    <h5 class="card-text">Nama Guru : {{ $mapel->users->name }}</h5>
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('siswa.enrollment', ['id' => $mapel->id_mapel]) }}"
                                            class="btn btn-primary">Enrollment</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h3 class="alert alert-info text-center">Belum ada mata pelajaran</h3>
                    @endforelse
                @endif
            </div>
        @endrole
    </div>
@endsection
