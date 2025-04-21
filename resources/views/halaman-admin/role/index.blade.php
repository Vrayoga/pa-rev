@extends('layout.MainLayout')

@section('content')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Data Role</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Role & Permission</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <a href="#" class="btn btn-primary btn-rounded waves-effect waves-light">
                                <i class="mdi mdi-plus me-1"></i> Tambah Role
                            </a>
                        </div>
                        
                        <h4 class="card-title">Tabel Role & Permission</h4>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th>Role</th>
                                    <th>Permissions</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $index => $role)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @foreach($role->permissions as $perm)
                                            <span class="badge bg-info text-dark">{{ $perm->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="#" method="POST" style="display:inline;">
                                            {{-- @csrf
                                            @method('DELETE') --}}
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus role ini?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable(); // pastikan id-nya sesuai
    });
</script>

@endsection
