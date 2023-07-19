@extends('new-layouts.app')

@section('content')
    <div class="col-md- col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Mapel</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-horizontal" action="{{ route('admin.mapel.assignStore') }}" method="POST">
                        {{-- @method('put') --}}
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Kode Mapel</label>
                                </div>
                                <div class="col-md-10 form-group">
                                    <input type="text" id="id_mapel" class="form-control" name="id_mapel"
                                        placeholder="Mapels" value="{{ $mapels->id_mapel }}" readonly required
                                        autocomplete="off">
                                </div>
                                <div class="col-md-2">
                                    <label>Guru</label>
                                </div>
                                <div class="col-md-10 form-group">
                                    <select class="form-select" name="nip" id="nip" required
                                        aria-label="Default select example">
                                        <option></option>
                                        @foreach ($gurus as $guru)
                                            <option value="{{ $guru->nomer_induk }}">{{ $guru->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-12
                                        d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('select2')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#nip').select2({
                placeholder: "--- Pilih Guru ---",
                allowClear: true
            });
        });
    </script>
@endsection
