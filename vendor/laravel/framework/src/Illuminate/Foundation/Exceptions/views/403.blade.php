@extends('errors::template')

@section('title', '403')
@section('error')

    <div class="error-page container">
        <div class="col-md-8 col-12 offset-md-2">
            <div class="text-center">
                <img class="img-error" src="{{ asset('assets/images/samples/error-403.svg') }}" alt="Not Found">
                <h1 class="error-title">Forbidden</h1>
                <p class="fs-5 text-gray-600">Anda tidak Diizinkan mengakses halaman ini</p>
                <a href="{{ url()->previous() }}" class="btn btn-lg btn-outline-primary mt-3">Go Back</a>
            </div>
        </div>
    </div>
@endsection
