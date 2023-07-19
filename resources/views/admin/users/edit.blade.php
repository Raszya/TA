@extends('new-layouts.app')

@section('content')
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Siswa</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Nama</label>
                                    <div class="position-relative">
                                        <input type="text" id="nis" name="nis" class="form-control"
                                            placeholder="Nomer Induk Siswa" value="{{ $user->name }}" disabled>
                                        <div class="form-control-icon">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Email</label>
                                    <div class="position-relative">
                                        <input type="text" id="nama" name="nama" class="form-control"
                                            placeholder="Nama" required value="{{ $user->email }}" disabled>
                                        <div class="form-control-icon">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <div class="fs-4">Roles</div>
                                    <div class="position-relative d-flex">
                                        @if ($user->roles)
                                            @foreach ($user->roles as $user_role)
                                                <form method="post"
                                                    action="{{ route('admin.users.roles.remove', [$user->id, $user_role->id]) }}"
                                                    onsubmit="return confirm('Ingin Melepas Role?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="badge bg-light-danger mx-1">{{ $user_role->name }}</button>
                                                </form>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="fs-4">Assign Role</div>
                                <form class="needs-validation" method="post"
                                    action="{{ route('admin.users.roles', $user->id) }}">
                                    @csrf
                                    <select class="form-select" id="role" name="role" required>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">
                                                {{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Assign</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
