@extends('layout.MainLayout')

@section('content')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Daftar Anggota Ekstrakurikuler {{ $ekstrakurikuler->nama_ekstrakurikuler ?? 'Ekstrakurikuler' }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ekstrakurikuler</a></li>
                            <li class="breadcrumb-item active">Anggota</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Anggota Aktif</h6>
                        <div>
                            <span class="badge bg-primary">Total Anggota: {{ $anggota->count() }}</span>
                            @if($ekstrakurikuler->jenis == 'pilihan')
                                <span class="badge bg-success ms-2">Sisa Kuota: {{ $ekstrakurikuler->kuota }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        @if($anggota->count() > 0)
                            <div class="alert alert-success">
                                Menampilkan {{ $anggota->count() }} anggota aktif untuk ekstrakurikuler {{ $ekstrakurikuler->nama_ekstrakurikuler }}
                            </div>
                        @else
                            <div class="alert alert-info">
                                Belum ada anggota yang terdaftar di ekstrakurikuler ini.
                            </div>
                        @endif
                        
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 5%;">No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Kelas</th>
                                        <th>No. Telepon</th>
                                        <th>No. Wali</th>
                                        <th>Tanggal Diterima</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($anggota as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->siswa->nama_lengkap ?? $item->nama_lengkap }}</td>
                                        <td>{{ $item->kelas->kelas }} {{ $item->kelas->jurusan ?? '' }}</td>
                                        <td>{{ $item->no_telepon }}</td>
                                        <td>{{ $item->nomer_wali }}</td>
                                        <td>{{ $item->updated_at->format('d/m/Y') }}</td>
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
</div>

@endsection