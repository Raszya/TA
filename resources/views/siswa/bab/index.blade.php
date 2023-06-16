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
    @if (!@empty($babs))
        @forelse($babs as $bab)
            <div class="card">
                <div class="card-header">
                    Bab {{ $loop->iteration }}
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $bab->nama }}</h5>
                    <p class="card-text">{{ $bab->desc }}</p>
                    <a href="{{ route('siswa.tugas', ['id' => $bab->id]) }}" class="btn btn-success">Detail</a>

                    </form>
                </div>
            </div>
        @empty
            <h3 class="alert alert-info text-center">Belum ada mata pelajaran</h3>
        @endforelse
    @endif
@endsection