@extends('new-layouts.app')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>User Management</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/user">User Management</a>
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
                {{-- <div>
                    <a class="btn btn-primary btn-sm" href="/user/create">
                        <i class="bi bi-plus-lg"></i>
                        Tambah User
                    </a>
                </div> --}}
                <br>
                <div class="table-responsive">
                    <table class="table table-striped" id="tbl_list">
                        <thead>
                            <tr>
                                <th class="text-center" width="25px">No</th>
                                <th class="text-center" width="500px">Nama</th>
                                <th class="text-center" width="500px">Email</th>
                                <th class="text-center" width="200px">Roles</th>
                                <th class="text-center" width="50px">Nama</th>
                                {{-- <th class="w-20px text-center">Aksi</th> --}}
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
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'roles',
                        name: 'roles',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    },
                ],
                columnDefs: [{
                    className: 'text-center',
                    targets: [0]
                }, {
                    className: 'text-center',
                    targets: [1]
                }, {
                    className: 'text-center',
                    targets: [2]
                }, {
                    className: 'text-center',
                    targets: [3]
                }, {
                    className: 'text-center',
                    targets: [4]
                }, ]
            });

            // get data
            $.ajax({
                url: "{{ url()->current() }}",
                type: 'get',
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                success: function(data) {
                    // console.log(data);
                    data.forEach(element => {
                        console.log(element);
                    });
                }
            })

            // Delete record
            $('table').on('click', '.deletesiswa', function() {
                var id = $(this).data('id');
                console.log(id)
                var deleteConfirm = confirm("Are you sure?");
                if (deleteConfirm == true) {
                    // AJAX request
                    $.ajax({
                        url: "{{ route('admin.siswa.destroy') }}",
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': CSRF_TOKEN
                        },
                        data: id,
                        success: function(response) {
                            console.log(response);
                            if (response.success == 1) {
                                alert("Record deleted.");

                                // Reload DataTable
                                table.ajax.reload();
                            } else {
                                alert("Invalid ID.");
                            }
                        }
                    });
                }

            });
        });
    </script>
@endsection
