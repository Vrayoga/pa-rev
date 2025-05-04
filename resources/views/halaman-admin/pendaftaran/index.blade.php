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
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Anggota Pendaftaran Ekstrakurikuler</h6>
                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal">Ekstrakurikuler yang diampuh</button>
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

{{-- modal view ekstrakurikuler by id --}}

<div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Ekstrakurikuler yang Diampuh</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @if($ekstrakurikulers->isEmpty())
                        <div class="col-12">
                            <div class="alert alert-info">
                                Anda belum mengampu ekstrakurikuler apapun.
                            </div>
                        </div>
                    @else
                        @foreach($ekstrakurikulers as $ekstra)
                        <div class="col-md-6 mb-3">
                            <div class="card p-1 border shadow-none">
                                <div class="p-3">
                                    <h5><a href="javascript:void(0);" class="text-dark">{{ $ekstra->nama_ekstrakurikuler }}</a></h5>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted mb-0">{{ $ekstra->Jadwal ?? 'Jadwal belum ditentukan' }}</p>
                                        <span class="badge {{ $ekstra->jenis == 'wajib' ? 'bg-danger' : 'bg-info' }}">
                                            {{ ucfirst($ekstra->jenis) }}
                                        </span>
                                    </div>
                                </div>
                                
                                @if($ekstra->image)
                                <div class="position-relative">
                                    <img src="{{ asset('storage/'.$ekstra->image) }}" alt="{{ $ekstra->nama_ekstrakurikuler }}" class="img-thumbnail">
                                </div>
                                @endif

                                <div class="p-3">
                                    <ul class="list-inline">
                                        <li class="list-inline-item me-3">
                                            <span class="text-muted">
                                                <i class="bx bx-user align-middle text-muted me-1"></i> 
                                                Kuota: 
                                                @if($ekstra->jenis == 'wajib')
                                                    Tak Terbatas
                                                @else
                                                    {{ $ekstra->kuota }}
                                                @endif
                                            </span>
                                        </li>
                                        <li class="list-inline-item me-3">
                                            <span class="text-muted">
                                                <i class="bx bx-check-circle align-middle text-muted me-1"></i> Diterima: {{ $ekstra->jumlah_pendaftar }}
                                            </span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span class="
                                                @if($ekstra->jenis == 'wajib')
                                                    text-success
                                                @else
                                                    text-{{ $ekstra->sisa_kuota > 0 ? 'success' : 'danger' }}
                                                @endif
                                            ">
                                                <i class="bx bx-clipboard align-middle me-1"></i> 
                                                Sisa Kuota: 
                                                @if($ekstra->jenis == 'wajib')
                                                    Tak Terbatas
                                                @else
                                                    {{ $ekstra->sisa_kuota }}
                                                @endif
                                            </span>
                                        </li>
                                    </ul>
                                    
                                    <p>{{ Str::limit($ekstra->deskripsi, 100) }}</p>

                                    @if($ekstra->jenis == 'pilihan' && $ekstra->sisa_kuota <= 0)
                                        <div class="alert alert-warning">
                                            Kuota ekstrakurikuler ini sudah penuh!
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Tutup</button>
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