@extends('layout.MainLayout')

@section('content')

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Data Logbook</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Data Logbook</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        
                        @can('create logbook')
                        @if (!Auth::user()->hasRole('admin'))
                        <div class="card-body">
                            <div class="d-flex justify-content-end mb-3">
                                <a href="{{route ('logbook.create')}}" class="btn btn-primary btn-rounded waves-effect waves-light">
                                    <i class="mdi mdi-plus me-1"> Tambah Data Logbook </i>
                                </a>
                            </div>
                            @endif
                            @endcan
                            <h4 class="card-title">Table Logbook</h4>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th>Ekstrakurikuler</th>
                                    <th>Kegiatan</th>
                                    <th>Tanggal kegiatan</th>
                                    <th>Jam mulai</th>
                                    <th>Jam selesai</th>
                                    <th>Foto kegiatan</th>
                                   
                                    <th>Action</th>
                                    
                                </tr>
                                </thead>

                                <tbody>
                                    @foreach($logbooks as $index => $logbook)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $logbook->ekstrakurikuler->nama_ekstrakurikuler ?? '-' }}</td>
                                        <td>{{ $logbook->Kegiatan }}</td>
                                        <td>{{ $logbook->Tanggal }}</td>
                                        <td>{{ $logbook->Jam_mulai }}</td>
                                        <td>{{ $logbook->Jam_selesai }}</td>
                                        <td>
                                            @if ($logbook->Foto_kegiatan)
                                                <img src="{{ asset('storage/' . $logbook->Foto_kegiatan) }}" alt="Foto Kegiatan" width="80">
                                            @else
                                                <span class="text-muted">Tidak ada foto</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!$logbook->is_locked)  <!-- Menggunakan !$logbook->is_locked untuk kejelasan -->
                                                @can('edit logbook')
                                                    <a href="{{ route('logbook.edit', $logbook->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                @endcan
                                                @can('delete logbook')
                                                    <form action="/logbook/{{ $logbook->id }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                @endcan
                                            @else
                                                <span class="badge bg-secondary">Locked</span>
                                            @endif
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

@endsection
