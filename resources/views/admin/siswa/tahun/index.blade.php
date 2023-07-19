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
                <div>
                    <a class="btn btn-primary btn-sm my-2" href="{{ route('admin.tahunajaran.create') }}">
                        <i class="bi bi-plus-lg"></i>
                        Tambah Tahun
                    </a>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped" id="tbl_list">
                            <thead>
                                <tr>
                                    <th class="w-10px text-center">No</th>
                                    <th class="w-200px text-center">tahun</th>
                                    <th class="text-center" width="50px">Aksi</th>
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
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'tahun',
                        name: 'tahun',
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
            // $('table').on('click', '.deletemapel', function(event) {
            //     event.preventDefault();
            //     var id = $(this).data('id_mapel');
            //     console.log(id)
            //     Swal.fire({
            //         title: "Apa kamu yakin ?",
            //         confirmButtonClass: "btn btn-primary mx-2",
            //         cancelButtonClass: "btn btn-danger",
            //         confirmButtonText: "Yakin!",
            //         showCancelButton: true,
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             $.ajax({
            //                 url: "{{ route('admin.mapel.destroy') }}",
            //                 type: 'post',
            //                 headers: {
            //                     'X-CSRF-TOKEN': CSRF_TOKEN
            //                 },
            //                 data: {
            //                     id_mapel: id
            //                 },
            //                 success: function(response) {
            //                     // console.log(response);
            //                     Swal.fire(
            //                         'Berhasil!',
            //                         response,
            //                         'success',
            //                     );
            //                     table.ajax.reload();
            //                 },
            //                 error: function(error) {
            //                     console.log(error);
            //                     Swal.fire(
            //                         'Gagal!',
            //                         'Ada kesalahan.',
            //                         'error',
            //                     );
            //                 }
            //             });
            //         } else if (result.dismiss === Swal.DismissReason.cancel) {
            //             Swal.fire(
            //                 'Batal!',
            //                 'Batal menghapus data.',
            //                 'error',
            //             );
            //         }
            //     });
            // });

            // Restore Record
            // $('table').on('click', '.restoremapel', function(event) {
            //     event.preventDefault();
            //     var id = $(this).data('id_mapel');
            //     console.log(id)
            //     Swal.fire({
            //         title: "Ingin Memulihkan ?",
            //         confirmButtonClass: "btn btn-primary mx-2",
            //         cancelButtonClass: "btn btn-danger",
            //         confirmButtonText: "Yakin!",
            //         showCancelButton: true,
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             $.ajax({
            //                 url: "{{ route('admin.mapel.restore') }}",
            //                 type: 'post',
            //                 headers: {
            //                     'X-CSRF-TOKEN': CSRF_TOKEN
            //                 },
            //                 data: {
            //                     id_mapel: id
            //                 },
            //                 success: function(response) {
            //                     console.log(response);
            //                     Swal.fire(
            //                         'Berhasil!',
            //                         response,
            //                         'success',
            //                     );
            //                     table.ajax.reload();
            //                 },
            //                 error: function(error) {
            //                     console.log(error);
            //                     Swal.fire(
            //                         'Gagal!',
            //                         'Ada kesalahan.',
            //                         'error',
            //                     );
            //                 }
            //             });
            //         } else if (result.dismiss === Swal.DismissReason.cancel) {
            //             Swal.fire(
            //                 'Batal!',
            //                 'Batal menghapus data.',
            //                 'error',
            //             );
            //         }
            //     });
            // });
        });
    </script>
@endsection
