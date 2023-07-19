@extends('new-layouts.app')

@section('content')
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Siswa</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="/admin/siswa/create" method="POST">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="first-name-icon">NIS</label>
                                        <div class="position-relative">
                                            <input type="text" id="nis" name="nis" class="form-control"
                                                placeholder="Nomer Induk Siswa" autocomplete="off" required autofocus
                                                maxlength="5">
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
                                                placeholder="Nama" required autocomplete="off">
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
                                                placeholder="No Telepon" required autocomplete="off">
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
                                                    id="jenisKelamin1" value="Laki-laki" required>
                                                <label class="form-check-label" for="jenisKelamin1">
                                                    Laki-laki
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenisKelamin"
                                                    id="jenisKelamin2" value="Perempuan">
                                                <label class="form-check-label" for="jenisKelamin2">
                                                    Perempuan
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="first-name-icon">Jurusan</label>
                                        <div class="position-relative">
                                            <fieldset class="form-group">
                                                <select class="form-select" id="jurusan" name="jurusan" required>
                                                    @foreach ($jurusans as $jurusan)
                                                        <option value="{{ $jurusan->id }}">{{ $jurusan->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="first-name-icon">Kelas</label>
                                        <div class="position-relative">
                                            <fieldset class="form-group">
                                                <select class="form-select" id="kelas" name="kelas" required>
                                                    @foreach ($kelas as $row)
                                                        <option value="{{ $row->id }}">{{ $row->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="first-name-icon">Tahun</label>
                                        <div class="position-relative">
                                            <fieldset class="form-group">
                                                <select class="form-select" id="tahun" name="tahun" required>
                                                    @foreach ($tahun as $row)
                                                        <option value="{{ $row->id }}">{{ $row->tahun }}</option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
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
