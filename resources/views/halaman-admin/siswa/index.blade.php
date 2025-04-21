@extends('layout.MainLayout')

@section('content')

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Data Siswa</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Data Siswa</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        
                        <div class="card-body">
                            <div class="d-flex justify-content-end mb-3">
                                <a href="/siswa-create" class="btn btn-primary btn-rounded waves-effect waves-light">
                                    <i class="mdi mdi-plus me-1"> Tambah Data Siswa </i>
                                </a>
                            </div>
                            
                            <h4 class="card-title">Table Siswa</h4>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama siswa</th>
                                    <th>Kelas</th>
                                    <th>Sekolah asal</th>
                                    <th>Tanggal lahir</th>
                                    <th>NIS</th>
                                    <th>Alamat</th>
                                    <th>Image</th>
                                    <th>No telepon</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                    @foreach($siswa as $index => $siswa)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $siswa->nama_siswa }}</td>
                                        <td>{{ $siswa->tingkat_kelas }} {{ $siswa->nama_jurusan }}</td>
                                        <td>{{ $siswa->sekolah_asal }}</td>
                                        <td>{{ $siswa->tanggal_lahir }}</td>
                                        <td>{{ $siswa->nis }}</td>
                                        <td>{{ $siswa->alamat }}</td>
                                        <td>
                                            @if($siswa->image)
                                                <img src="{{ asset('storage/' . $siswa->image) }}" alt="Image" width="50">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>{{ $siswa->no_telepon }}</td>
                                        <td>
                                            <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Delete</button>
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
            $('#dataTableExample').DataTable();
        });
    </script>
@endsection
