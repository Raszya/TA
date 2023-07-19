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
        @forelse($babs as $mapel)
            @foreach ($mapel->mapels->bab as $bab)
                @if ($bab->id_mapel == $id)
                    @php
                        $nilaiMapel = [];
                        foreach ($bab->tugas as $tugas) {
                            foreach ($tugas->jawaban as $jawaban) {
                                if ($jawaban->id_user == Auth::user()->id && isset($jawaban->nilai->nilai)) {
                                    array_push($nilaiMapel, (float) $jawaban->nilai->nilai);
                                }
                            }
                        }
                        if (count($nilaiMapel) > 0) {
                            $nilaiAkhirMapel = array_sum($nilaiMapel) / count($nilaiMapel);
                        } else {
                            $nilaiAkhirMapel = 0;
                        }
                    @endphp
                    <div class="card">
                        <div class="card-header">
                            Bab {{ $loop->iteration }}
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $bab->nama }}</h5>
                            <p class="card-text">Deskripsi : {{ $bab->desc }}<br>
                                Nilai Rata-Rata Bab : {{ $nilaiAkhirMapel }}
                            </p>
                            <a href="{{ route('siswa.tugas', ['id' => $bab->id]) }}" class="btn btn-success">Detail</a>
                            </form>
                        </div>
                    </div>
                @endif
            @endforeach
        @empty
            <h3 class="alert alert-info text-center">Belum ada mata pelajaran</h3>
        @endforelse
    @endif
@endsection
