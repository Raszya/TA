@extends('new-layouts.app')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>List Mapel</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.listsiswa') }}">List Mapel</a>
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
                    <a class="btn btn-primary btn-sm" href="/user/create">
                        <i class="bi bi-plus-lg"></i>
                        Tambah Mapel
                    </a>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped" id="tbl_list">
                            <thead>
                                <tr>
                                    <th class="w-10px text-center">No</th>
                                    <th class="w-200px text-center">Nama Guru</th>
                                    <th class="w-200px text-center">Nama Mata Pelajaran</th>
                                    <th class="w-200px text-center">Kode Akses</th>
                                    {{-- <th class="w-200px text-center">Role</th> --}}
                                    <th class="w-200px text-center">Status</th>
                                    <th class="w-20px text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @if (!@empty($mapels))
                                    @forelse ($mapels as $mapel)
                                        <tr>
                                            <td class="align-top text-center"> {{ $loop->iteration }}</td>
                                            <td class="align-top">
                                                {{ $mapel->nama }}
                                            </td>
                                            <td class="align-top text-center">
                                                {{ $mapel->kode_akses }}
                                            </td>
                                            <td class="align-top text-center">
                                                {{ $mapel->status }}
                                            </td>
                                            <td class="text-center d-flex gap-1 justify-content-center in-line align-top"
                                                data-kt-menu="true">
                                                <form method="GET" action="">
                                                    <button class="btn icon btn-sm btn-warning" title="Edit">
                                                        <i class="bi bi-pencil-square"></i>
                                                </form>
                                                <form action="" method="POST" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn icon btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure?')" title="Hapus User?">
                                                        <i class="bi bi-trash3-fill"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">
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
    <script type="text/javascript">
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
                    var table = $('#tbl_list').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '{{ url()->current() }}',
                        columns: [{
                                data: 'id_mapel',
                                name: 'id_mapel',
                                render: function(data, type, row, meta) {
                                    return meta.row + meta.settings._iDisplayStart + 1;
                                }
                            },
                            {
                                data: 'users.name',
                                name: 'nama'
                            },
                            {
                                data: 'nama',
                                name: 'nama'
                            },
                            {
                                data: 'kode_akses',
                                name: 'kode_akses'
                            },
                            {
                                data: 'desc',
                                name: 'desc'
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
                    $('table').on('click', '.deletemapel', function(event) {
                        event.preventDefault();
                        var id = $(this).data('id');
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
                    });
    </script>
@endsection
