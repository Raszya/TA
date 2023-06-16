@extends('new-layouts.app')

@section('content')
    <div class="col-md- col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Bab</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-horizontal" action="{{ route('guru.bab.update', ['id' => $babs->id]) }}"
                        method="POST">
                        @method('put')
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Nama Bab</label>
                                </div>
                                <div class="col-md-10 form-group">
                                    <input type="text" id="nama" class="form-control" name="nama"
                                        placeholder="Nama Mapel" value="{{ $babs->nama }}" required>
                                </div>
                                <div class="col-md-2">
                                    <label>Deskripsi</label>
                                </div>
                                <div class="col-md-10 form-group">
                                    <input type="text" id="desc" class="form-control" name="desc"
                                        placeholder="Deskripsi Mapel" value="{{ $babs->desc }}" required>
                                </div>
                                <div class="col-sm-12 d-flex justify-content-end">
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
