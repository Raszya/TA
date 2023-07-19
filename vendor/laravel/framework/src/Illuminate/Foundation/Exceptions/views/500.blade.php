@extends('errors::template')

@section('title', 'Server Error')
@section('error')
    <div class="error-page container">
        <div class="col-md-8 col-12 offset-md-2">
            <div class="text-center">
                <img class="img-error" src="{{ asset('assets/images/samples/error-500.svg') }}" alt="Not Found">
                <h1 class="error-title">Sistem Error</h1>
                <p class="fs-5 text-gray-600">The website is currently unaivailable. Try again later or contact the
                    developer.</p>
                <a href="{{ url()->previous() }}" class="btn btn-lg btn-outline-primary mt-3">Go Back</a>
            </div>
        </div>
    </div>
@endsection
