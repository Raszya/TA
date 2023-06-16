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
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.guru.create') }}">
                        <i class="bi bi-plus-lg"></i>
                        Tambah Guru
                    </a>
                    <a class="btn btn-success btn-sm" href="{{ route('admin.downloaddataguru') }}" target="_blank">
                        <i class=""></i>
                        Export Excel
                    </a>
                    <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#uploaddata">
                        Upload Excel
                    </button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="uploaddata" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Upload Data Guru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.uploaddataguru') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="data_guru" class="form-control" required><br>
                                    <button type="" class="btn btn-primary ">Upload</button>
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
                                <th class="w-200px text-center">NIP</th>
                                <th class="w-200px text-center">Nama</th>
                                {{-- <th class="w-200px text-center">Role</th> --}}
                                <th class="w-200px text-center">Alamat</th>
                                <th class="w-200px text-center">Notelp</th>
                                <th class="w-20px text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

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
                        data: 'nomer_induk',
                        name: 'nomer_induk',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'nomer_induk',
                        name: 'nomer_induk'
                    },
                    {
                        data: 'nama',
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
                        searchable: false
                    },

                ]
            });

            // Delete record
            $('table').on('click', '.deleteguru', function(event) {
                event.preventDefault();
                var id = $(this).data('nomer_induk');
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
                            url: "{{ route('admin.guru.destroy') }}",
                            type: 'post',
                            headers: {
                                'X-CSRF-TOKEN': CSRF_TOKEN
                            },
                            data: {
                                nomer_induk: id
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
            });
        });
    </script>
@endsection
