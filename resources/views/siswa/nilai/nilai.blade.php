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
                <div class="col-1">
                    <select class="form-select" id="tahun" name="tahun" required>
                        @foreach ($tahun as $row)
                            <option value="{{ $row->id }}" @if (isset($id) && $id == $row->id) selected @endif>
                                {{ $row->thn }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="mytable">
                        <thead>
                            <tr>
                                <th class="w-10px text-center">No</th>
                                <th class="w-200px text-center">Nama Mapel</th>
                                <th class="w-200px text-center">Nilai angka</th>
                                <th class="w-200px text-center">Nilai huruf</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nilai as $mapel)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $mapel->mapels->nama }}</td>
                                    @php
                                        $nilaiMapel = [];
                                        foreach ($mapel->mapels->bab as $bab) {
                                            foreach ($bab->tugas as $tugas) {
                                                foreach ($tugas->jawaban as $jawaban) {
                                                    if ($jawaban->id_user == Auth::user()->id && isset($jawaban->nilai->nilai)) {
                                                        array_push($nilaiMapel, (float) $jawaban->nilai->nilai);
                                                    }
                                                }
                                            }
                                        }
                                        if (count($nilaiMapel) > 0) {
                                            $nilaiAkhirMapel = array_sum($nilaiMapel) / count($nilaiMapel);
                                        } else {
                                            $nilaiAkhirMapel = 0;
                                        }
                                    @endphp
                                    <td class="text-center">{{ $nilaiAkhirMapel }}</td>
                                    <td class="text-center">
                                        @switch($nilaiAkhirMapel)
                                            @case($nilaiAkhirMapel >= 90)
                                                A
                                            @break

                                            @case($nilaiAkhirMapel >= 80)
                                                B
                                            @break

                                            @case($nilaiAkhirMapel >= 70)
                                                C
                                            @break

                                            @case($nilaiAkhirMapel >= 60)
                                                D
                                            @break

                                            @case($nilaiAkhirMapel >= 0)
                                                E
                                            @break

                                            @default
                                                E
                                        @endswitch
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <script>
        // Fungsi untuk mengarahkan ke URL dengan tahun yang dipilih
        function redirectToSelectedYear() {
            const selectElement = document.getElementById('tahun');
            const selectedYear = selectElement.value;
            const url = "/siswa/nilai/" + selectedYear;
            window.location.href = url;
        }

        // Tambahkan event onchange ke elemen select
        document.getElementById('tahun').addEventListener('change', redirectToSelectedYear);
    </script>
@endsection
