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
                    </nav>
                </div>
            </div>
        </div>
    </div>

    {{-- body --}}
    <div class="row">
        @if (!@empty($Trx_guru))
            @forelse($Trx_guru as $mapel)
                <div class="col-sm-7 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $mapel->mapel->nama }}</h5>
                            <p class="card-text">{{ $mapel->mapel->desc }}</p>
                            <div class="d-flex">
                                <a href="{{ route('guru.mapel.edit', $mapel->id) }}" class="btn btn-warning">edit</a>
                                <a href="{{ route('guru.bab', ['id' => $mapel->mapel->id_mapel]) }}"
                                    class="btn btn-primary mx-1">detail</a>
                                <form action="{{ route('guru.mapel.destroy', ['id' => $mapel->id]) }}" method="POST"
                                    class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')"
                                        title="Hapus User?">Selesai</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h3 class="alert alert-info text-center">Belum ada mata pelajaran</h3>
            @endforelse
        @endif
    </div>
@endsection
