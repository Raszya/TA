@extends('new-layouts.app')

@section('content')
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Guru</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical"
                        action="{{ route('admin.guru.update', ['nomer_induk' => $guru->nomer_induk]) }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="first-name-icon">NIP</label>
                                        <div class="position-relative">
                                            <input type="text" id="nomer_induk" name="nomer_induk" class="form-control"
                                                placeholder="Nomer Induk Siswa" value="{{ $guru->nomer_induk }}" disabled>
                                            <div class="form-control-icon">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="first-name-icon">Nama</label>
                                        <div class="position-relative">
                                            <input type="text" id="nama" name="nama" class="form-control"
                                                placeholder="Nama" required value="{{ $guru->nama }}">
                                            <div class="form-control-icon">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="first-name-icon">No Telepon</label>
                                        <div class="position-relative">
                                            <input type="number" id="noTelp" name="noTelp" class="form-control"
                                                placeholder="No Telepon" required value="{{ $guru->notelp }}">
                                            <div class="form-control-icon">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="first-name-icon">Jenis Kelamin</label>
                                        <div class="d-flex gap-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenisKelamin"
                                                    id="jenisKelamin1" value="Laki-laki" required
                                                    {{ $guru->jk === 'Laki-laki' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="jenisKelamin1">
                                                    Laki-laki
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenisKelamin"
                                                    id="jenisKelamin2" value="Perempuan"
                                                    {{ $guru->jk === 'Perempuan' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="jenisKelamin2">
                                                    Perempuan
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ $guru->alamat }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
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
