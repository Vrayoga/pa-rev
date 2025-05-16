@extends('layout.MainLayout')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Daftar Siswa Kelas {{ $kelas->tingkat }} {{ $kelas->jurusan->nama_jurusan }} {{ $kelas->kode_kelas }}</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NISN</th>
                                        <th>Nama Siswa</th>
                                        <th>Status</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Tanggal Masuk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($siswaDiKelas as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->siswa->nis_nip }}</td>
                                        <td>{{ $item->siswa->nama_siswa }}</td>
                                        <td>
                                            <span class="badge bg-{{ 
                                                $item->status == 'naik' ? 'success' : 
                                                ($item->status == 'tidak_naik' ? 'warning' : 'primary')
                                            }}">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $item->tahun_ajaran }}</td>
                                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
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