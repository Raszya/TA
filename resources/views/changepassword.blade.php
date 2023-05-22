@extends('new-layouts.app')
@section('content')
    <div class="card-content">
        <div class="card-body">
            <form class="form form-vertical" method="POST" action="{{ route('user.changePassword') }}">
                <div class="form-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="password-vertical">Passowrd Lama</label>
                                    <input type="password" id="password-vertical" class="form-control"
                                        name="current_password" placeholder="Password Lama">
                                </div>
                                <div class="form-group">
                                    <label for="password-vertical">Password Baru</label>
                                    <input type="password" id="password-vertical" class="form-control" name="password"
                                        placeholder="Password Baru">
                                </div>
                                <div class="form-group">
                                    <label for="password-vertical">Konfirmasi Password Baru</label>
                                    <input type="password" id="password-vertical" class="form-control"
                                        name="password_confirmation" placeholder="Konfirmasi Password Baru">
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Update Password</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
@endsection
