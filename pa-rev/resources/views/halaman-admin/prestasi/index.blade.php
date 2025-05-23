@extends('layout.MainLayout')

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Data Prestasi</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <a href="{{ route('prestasi.create') }}" class="btn btn-primary btn-rounded waves-effect waves-light">
                                <i class="mdi mdi-plus me-1"> Tambah Prestasi </i>
                            </a>
                        </div>

                        <h4 class="card-title">Table Prestasi</h4>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Peringkat</th>
                                    <th>Tanggal</th>
                                    <th>Tingkat</th>
                                    <th>Ekstrakurikuler</th>
                                    <th>Nama Siswa</th>
                                    <th>Foto</th>
                                    <th>Deskripsi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prestasis as $index => $prestasi)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $prestasi->nama_kegiatan }}</td>
                                        <td>{{ $prestasi->peringkat }}</td>
                                        <td>{{ \Carbon\Carbon::parse($prestasi->tanggal_kejuaraan)->format('d M Y') }}</td>
                                        <td>{{ $prestasi->tingkat_kejuaraan }}</td>
                                        <td>{{ $prestasi->ekstrakurikuler->nama_ekstrakurikuler ?? '-' }}</td>
                                        <td>{{ $prestasi->siswa->nama_siswa ?? '-' }}</td>
                                        <td>
                                            @if ($prestasi->foto_prestasi)
                                                <img src="{{ asset('storage/images/' . $prestasi->foto_prestasi) }}" alt="Foto" width="50">
                                            @else
                                                <span class="text-danger">N/A</span>
                                            @endif
                                        </td>
                                        <td>{{ $prestasi->deskripsi ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('prestasi.edit', $prestasi->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                            <form action="{{ route('prestasi.destroy', $prestasi->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
