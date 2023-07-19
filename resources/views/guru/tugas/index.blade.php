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
            <a href="{{ route('guru.modul.create', ['id' => $id]) }}" class="btn btn-info my-2">Tambah Modul</a>
            @if (!@empty($moduls))
                @forelse ($moduls as $modul)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Modul {{ $loop->iteration }}</h5>
                            {{-- <p class="card-text">{{ $modul->dir_modul }}</p> --}}
                            {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#pdfModal">
                                Lihat Dokumen
                            </button> --}}
                            <a type="button" href="{{ Storage::url($modul->dir_modul) }}"
                                class="btn btn-primary my-1">Download
                                Modul</a>
                            <a href="#" class="btn btn-warning">Edit</a>
                            <a href="#" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                @empty
                    <h5 class="alert alert-warning text-center">Belum ada Modul</h5>
                @endforelse
            @endif
        </div>
        <div class="col-sm-6">
            <a href="{{ route('guru.tugas.create', ['id' => $id]) }}" class="btn btn-info my-2">Tambah Tugas</a>
            @if (!@empty($tugass))
                @forelse ($tugass as $tugas)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tugas {{ $loop->iteration }}</h5>
                            <p class="card-text">Deskripsi : {{ $tugas->desc }}
                                <br> Deadline : {{ $tugas->deadline }}
                                <br> Jenis Tugas : @if ($tugas->jenisTugas == 1)
                                    dengan deadline
                                @else
                                    Tanpa deadline
                                @endif
                            </p>
                            <a type="button" href="{{ route('guru.penilaian', ['id' => $tugas->id]) }}"
                                class="btn btn-primary my-1">Penilaian</a>
                            <a href="#" class="btn btn-warning">Edit</a>
                            <a href="#" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                @empty
                    <h5 class="alert alert-warning text-center">Belum ada Modul</h5>
                @endforelse
            @endif
        </div>
    </div>

@endsection

{{-- @section('showpdfmodul')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.8.335/pdf.min.js"></script> --}}
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
{{-- @endsection --}} --}}
