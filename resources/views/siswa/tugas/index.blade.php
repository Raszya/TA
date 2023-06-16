@extends('new-layouts.app')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Mapel</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                {{-- <a href="{{ route('guru.mapel') }}">List Siswa</a> --}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            @if (!@empty($moduls))
                @forelse ($moduls as $modul)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Modul {{ $loop->iteration }}</h5>
                            <p class="card-text">{{ $modul->desc }}</p>
                            {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#pdfModal">
                                Lihat Dokumen
                            </button> --}}
                            <a type="button" href="{{ Storage::url($modul->dir_modul) }}"
                                class="btn btn-primary my-1">Download
                                Modul</a>
                        </div>
                    </div>
                @empty
                    <h5 class="alert alert-warning text-center">Belum ada Modul</h5>
                @endforelse
            @endif
        </div>
        <div class="col-sm-6">
            @if (!@empty($tugass))
                @forelse ($tugass as $tugas)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tugas {{ $loop->iteration }}</h5>
                            <p class="card-text">{{ $tugas->desc }}</p>
                            <a type="button" href="{{ Storage::url($tugas->dir_tugas) }}"
                                class="btn btn-primary my-1">Download
                                Tugas</a>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#modal">Upload Tugas</button>
                        </div>
                    </div>
                @empty
                    <h5 class="alert alert-warning text-center">Belum ada Tugas</h5>
                @endforelse
            @endif
        </div>
        <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pdfModalLabel">Upload Tugas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('siswa.jawaban', ['id' => $tugas->id]) }}" enctype="multipart/form-data"
                        method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="col-md-2">
                                <label>Upload Tugas</label>
                            </div>
                            <div class="col-md-10 form-group">
                                <input type="file" id="dir_tugas" class="form-control" name="dir_jawaban"
                                    placeholder="Upload Modul" required autocomplete="off">
                            </div>
                            <div class="col-sm-12
                                        d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('showpdfmodul')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.8.335/pdf.min.js"></script>
    {{-- <script>
        var pdfPath =
            "{{ route('guru.modul.showpdf', ['id1' => $moduls->id, 'id' => $id]) }}";

        console.log(pdfPath)

        document.addEventListener("DOMContentLoaded", function() {
            PDFJS.getDocument(pdfPath).promise.then(function(pdfDoc) {
                var viewer = document.getElementById("pdfContainer");
                var pageNumber = 1;

                pdfDoc.getPage(pageNumber).then(function(page) {
                    var scale = 1.5;
                    var viewport = page.getViewport({
                        scale: scale
                    });

                    var canvas = document.createElement("canvas");
                    var context = canvas.getContext("2d");
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    var renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };

                    viewer.appendChild(canvas);
                    page.render(renderContext);
                });
            });
        });
    </script> --}}
@endsection
