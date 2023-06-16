@extends('new-layouts.app')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>List Siswa</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.listsiswa') }}">List Siswa</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <div class="flash-message">
                    {{-- @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if (Session::has('alert-' . $msg))
                            <p id="alert" class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                            </p>
                        @endif
                    @endforeach --}}
                </div>
                <div>
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.siswa.create') }}">
                        <i class="bi bi-plus-lg"></i>
                        Tambah Siswa
                    </a>
                    <a class="btn btn-success btn-sm" href="{{ route('admin.downloaddatasiswa') }}" target="_blank">
                        <i class=""></i>
                        Export Excel
                    </a>
                    <button type="button" class="btn btn-light btn-sm text-black" data-bs-toggle="modal"
                        data-bs-target="#uploaddata">
                        Upload Excel
                    </button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="uploaddata" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Upload Data Siswa</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.uploaddatasiswa') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="data_siswa" class="form-control" required><br>
                                    <button type="" class="btn btn-primary">Upload</button>
                                </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="table-responsive">
                    <table class="table table-striped" id="tbl_list">
                        <thead>
                            <tr>
                                <th class="w-10px text-center">No</th>
                                <th class="w-200px text-center">Nis</th>
                                <th class="w-200px text-center">Nama</th>
                                <th class="w-200px text-center">Jurusan</th>
                                <th class="w-200px text-center">Alamat</th>
                                <th class="w-200px text-center">Notelp</th>
                                <th class="w-200px text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @if (!@empty($siswas))
                                @forelse ($siswas as $siswa)
                                    <tr>
                                        <td class="align-top text-center"> {{ $loop->iteration }}</td>
                                        <td class="align-top text-center">
                                            {{ $siswa->nis }}
                                        </td>
                                        <td class="align-top">
                                            {{ $siswa->nama }}
                                        </td>
                                        <td class="align-top text-center">
                                            {{ $siswa->jurusan->nama }}
                                        </td>
                                        <td class="align-top">
                                            {{ $siswa->alamat }}
                                        </td>
                                        <td class="align-top">
                                            {{ $siswa->notelp }}
                                        </td>
                                        <td class="text-center d-flex gap-1 justify-content-center in-line align-top"
                                            data-kt-menu="true">
                                            <form method="get"
                                                action="{{ route('admin.siswa.edit', ['nis' => $siswa->nis]) }}">
                                                <button class="btn icon btn-sm btn-warning" title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.siswa.destroy', $siswa->nis) }}" method="POST"
                                                class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn icon btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure?')" title="Hapus Siswa?">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <strong>Belum Ada Data</strong>
                                        </td>
                                    </tr>
                                @endforelse
                            @endif --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            var table = $('#tbl_list').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url()->current() }}',
                columns: [{
                        data: 'nis',
                        name: 'nis',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'nis',
                        name: 'nis'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'jurusan.nama',
                        name: 'nama'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'notelp',
                        name: 'notelp'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    },

                ]
            });

            // Delete record
            $('table').on('click', '.deletesiswa', function(event) {
                event.preventDefault();
                var id = $(this).data('nis');
                console.log(id)
                Swal.fire({
                    title: "Apa kamu yakin ?",
                    confirmButtonClass: "btn btn-primary mx-2",
                    cancelButtonClass: "btn btn-danger",
                    confirmButtonText: "Yakin!",
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.siswa.destroy') }}",
                            type: 'post',
                            headers: {
                                'X-CSRF-TOKEN': CSRF_TOKEN
                            },
                            data: {
                                nis: id
                            },
                            success: function(response) {
                                // console.log(response);
                                Swal.fire(
                                    'Berhasil!',
                                    response,
                                    'success',
                                );
                                table.ajax.reload();
                            },
                            error: function(error) {
                                console.log(error);
                                Swal.fire(
                                    'Gagal!',
                                    'Ada kesalahan.',
                                    'error',
                                );
                            }
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire(
                            'Batal!',
                            'Batal menghapus data.',
                            'error',
                        );
                    }
                });

                // Swal.fire({
                //     title: "Any fool can use a computer",
                //     confirmButtonClass: "btn btn-primary",
                //     buttonsStyling: !1,
                // });

                // if (deleteConfirm === true) {
                //     // AJAX request
                //     $.ajax({
                //         url: "{{ route('admin.siswa.destroy') }}",
                //         type: 'post',
                //         headers: {
                //             'X-CSRF-TOKEN': CSRF_TOKEN
                //         },
                //         data: id,
                //         success: function(response) {
                //             console.log(response);
                //             if (response.success == 1) {
                //                 alert("Record deleted.");

                //                 // Reload DataTable
                //                 table.ajax.reload();
                //             } else {
                //                 alert("Invalid ID.");
                //             }
                //         }
                //     });
                // }

            });
        });
    </script>
@endsection
