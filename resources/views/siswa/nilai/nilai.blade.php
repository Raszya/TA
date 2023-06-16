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
                <div class="table-responsive">
                    <table class="table table-striped" id="tabel1">
                        <thead>
                            <tr>
                                <th class="w-10px text-center">No</th>
                                <th class="w-200px text-center">Nama Mapel</th>
                                <th class="w-200px text-center">Nilai angka</th>
                                <th class="w-200px text-center">Nilai huruf</th>
                                <th class="w-20px text-center">Detail nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nilai as $item)
                                {{-- @if ($item->bab->tugas->jawaban->user->id == Auth::user()->id) --}}
                                {{-- {{ dd($item->bab[]) }} --}}
                                {{-- @dump($item->bab[0]]) --}}
                                <tr>
                                    <td class="align-top text-center">{{ $loop->iteration }}</td>
                                    <td class="align-top">{{ $item->bab }}</td>
                                </tr>
                                {{-- @endif --}}
                            @endforeach
                            {{-- @if ($nilai)
                                @forelse ($nilai as $row)
                                    @dump($row)
                                    <tr>
                                        <td class="align-top text-center"> {{ $loop->iteration }}</td>
                                        <td class="align-top">
                                            {{ $row->nama }}
                                        </td>
                                        <td class="align-top">
                                            {{ $row->bab->nama }}
                                        </td>
                                        <td class="align-top">
                                            {{ $row->bab->tugas->jawaban->nilai->nilai }}
                                        </td>
                                        <td class="text-center d-flex gap-1 justify-content-center in-line align-top"
                                            data-kt-menu="true">
                                            <form method="GET" action="">
                                                <button class="btn icon btn-sm btn btn-warning"> <i
                                                        class="bi bi-pencil-square"></i></button>
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
    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script> --}}
    {{-- <script type="text/javascript">
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
                        data: 'email',
                        name: 'role'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    },

                ]
            });

            // get data
            // $.ajax({
            //     url: "",
            //     type:
            // })

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
    </script> --}}
@endsection
