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
            <br>
            <div class="table-responsive">
                <table class="table table-striped" id="tabel1">
                    <thead>
                        <tr>
                            <th class="w-10px text-center">No</th>
                            <th class="w-200px text-center">Nama Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!@empty($roles))
                            @forelse ($roles as $role)
                                <tr>
                                    <td class="align-top text-center"> {{ $loop->iteration }}</td>
                                    <td class="align-top text-center">
                                        {{ $role->name }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <strong>Belum Ada Data</strong>
                                    </td>
                                </tr>
                            @endforelse
                        @endif
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
@endsection
