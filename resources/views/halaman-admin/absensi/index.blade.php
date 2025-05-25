@extends('layout.MainLayout')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Absensi Ekstrakurikuler</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Absensi</a></li>
                            <li class="breadcrumb-item active">Siswa</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title text-white">Sesi Absensi: {{ $sesiAktif->jadwals->ekstrakurikuler->nama_ekstrakurikuler }}</h4>
                        <p class="mb-0 text-white-50">
                            Hari: {{ $sesiAktif->jadwals->hari }}, 
                            Jam: {{ $sesiAktif->jadwals->jam_mulai }} - {{ $sesiAktif->jadwals->jam_selesai }}
                        </p>
                    </div>
                    
                    <div class="card-body">
                        <form action="{{ route('absensi.simpan') }}" method="POST">
                            @csrf
                            <input type="hidden" name="sesi_absen_ekstrakurikuler_id" value="{{ $sesiAktif->id }}">
                            
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama Siswa</th>
                                        <th>Kelas</th>
                                        <th width="20%">Status</th>
                                        <th>Catatan</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($anggota as $index => $siswa)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $siswa->user->name }}</td>
                                       <td>{{ $siswa->user->siswa->kelasAktif?->kelas?->tingkat ?? '-' }} {{ $siswa->user->siswa->kelasAktif?->kelas->jurusan->nama_jurusan ?? '-' }}  {{ $siswa->user->siswa->kelasAktif?->kelas->kode_kelas ?? '-' }}</td>
                                        <td>
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-outline-success {{ optional($siswa->absensiEkstrakurikuler->first())->status == 'hadir' ? 'active' : '' }}">
                                                    <input type="radio" name="status[{{ $siswa->id }}]" value="hadir" autocomplete="off" 
                                                           {{ optional($siswa->absensiEkstrakurikuler->first())->status == 'hadir' ? 'checked' : '' }} required> Hadir
                                                </label>
                                                <label class="btn btn-outline-primary {{ optional($siswa->absensiEkstrakurikuler->first())->status == 'izin' ? 'active' : '' }}">
                                                    <input type="radio" name="status[{{ $siswa->id }}]" value="izin" autocomplete="off"
                                                           {{ optional($siswa->absensiEkstrakurikuler->first())->status == 'izin' ? 'checked' : '' }}> Izin
                                                </label>
                                                <label class="btn btn-outline-warning {{ optional($siswa->absensiEkstrakurikuler->first())->status == 'sakit' ? 'active' : '' }}">
                                                    <input type="radio" name="status[{{ $siswa->id }}]" value="sakit" autocomplete="off"
                                                           {{ optional($siswa->absensiEkstrakurikuler->first())->status == 'sakit' ? 'checked' : '' }}> Sakit
                                                </label>
                                                <label class="btn btn-outline-danger {{ optional($siswa->absensiEkstrakurikuler->first())->status == 'alfa' ? 'active' : '' }}">
                                                    <input type="radio" name="status[{{ $siswa->id }}]" value="alfa" autocomplete="off"
                                                           {{ optional($siswa->absensiEkstrakurikuler->first())->status == 'alfa' ? 'checked' : '' }}> Alfa
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="catatan[{{ $siswa->id }}]" 
                                                   class="form-control" 
                                                   value="{{ optional($siswa->absensiEkstrakurikuler->first())->catatan }}" 
                                                   placeholder="Keterangan">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                            
                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-primary">Simpan Absensi</button>
                                {{-- <a href="{{ route('absensi.selesai', $sesiAktif->id) }}" class="btn btn-danger">Selesaikan Sesi</a> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .table th, .table td {
        vertical-align: middle;
    }
    .card-header {
        padding: 1rem 1.5rem;
    }
</style>
@endsection