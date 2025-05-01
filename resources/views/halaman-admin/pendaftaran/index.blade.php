@extends('layout.MainLayout')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Daftar Anggota Ekstrakurikuler {{ $pendaftarans->first()->ekstrakurikuler->nama_ekstrakurikuler ?? 'Ekstrakurikuler' }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Anggota Ekstrakurikuler</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Anggota Pendaftaran Ekstrakurikuler</h6>
                    </div>
                    <div class="card-body">
                        @if(auth()->user()->hasRole('guru'))
                            @if($pendaftarans->count() > 0)
                                <p>Menampilkan pendaftaran untuk ekstrakurikuler yang Anda bimbing</p>
                            @else
                                <div class="alert alert-info">
                                    Anda belum memiliki atau belum ada pendaftaran untuk ekstrakurikuler yang Anda bimbing.
                                </div>
                            @endif
                        @endif

                        <h4 class="card-title">Table Pendaftaran</h4>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Kelas</th>
                                    <th>No. Telepon</th>
                                    <th>No. Wali</th>
                                    <th>Alasan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendaftarans as $index => $pendaftaran)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pendaftaran->nama_lengkap }}</td>
                                    <td>{{ $pendaftaran->kelas->kelas }} {{$pendaftaran->kelas->jurusan}} </td>
                                    <td>{{ $pendaftaran->no_telepon }}</td>
                                    <td>{{ $pendaftaran->nomer_wali }}</td>
                                    <td>{{ $pendaftaran->alasan }}</td>
                                    <td>
                                        @if($pendaftaran->status_validasi == 'pending')
                                            <span class="badge badge-warning" style="background-color: #ffc107; color: #000;">Pending</span>
                                        @elseif($pendaftaran->status_validasi == 'diterima')
                                            <span class="badge badge-success" style="background-color: #28a745; color: #fff;">Diterima</span>
                                        @elseif($pendaftaran->status_validasi == 'ditolak')
                                            <span class="badge badge-danger" style="background-color: #dc3545; color: #fff;">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($pendaftaran->status_validasi == 'pending')
                                            <form action="{{ route('pendaftaran.validasi', $pendaftaran->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="diterima">
                                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Terima pendaftaran ini?')">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('pendaftaran.validasi', $pendaftaran->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="ditolak">
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tolak pendaftaran ini?')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
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

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endpush

<style>
    table.dataTable td {
        white-space: normal !important;
    }
</style>
@endsection