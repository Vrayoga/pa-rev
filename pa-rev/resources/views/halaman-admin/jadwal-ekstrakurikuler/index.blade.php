@extends('layout.MainLayout')

@php
    $user = auth()->user();
@endphp

@section('content')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Data Jadwal Ekstrakurikuler</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Data Jadwal Ekstrakurikuler</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    
                    <div class="card-body">
                        @if ($ekstrakurikuler->isNotEmpty() || !$user->hasRole('guru'))
                        <div class="d-flex justify-content-end mb-3">
                            <a href="{{ route('jadwal.create') }}" class="btn btn-primary btn-rounded waves-effect waves-light">
                                <i class="mdi mdi-plus me-1"> Tambah Data Jadwal </i>
                            </a>
                        </div>
                    @endif
                    
                    

                        <h4 class="card-title">Tabel Jadwal Ekstrakurikuler</h4>

                        @if ($jadwal->isEmpty() && $user->hasRole('guru'))
                            <div class="alert alert-warning">
                                Anda belum menambahkan jadwal ekstrakurikuler apapun.
                            </div>
                        @else
                            <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">No</th>
                                        <th>Nama Ekstrakurikuler</th>
                                        <th>Hari</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($jadwal as $index => $jadwals)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $jadwals->nama_ekstrakurikuler }}</td>
                                        <td>{{ ucfirst($jadwals->hari) }}</td> 
                                        <td>{{ $jadwals->jam_mulai }}</td>
                                        <td>{{ $jadwals->jam_selesai }}</td>
                                        <td>
                                           
                                                <a href="{{ route('jadwal.edit', $jadwals->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                            <form action="{{ route('jadwal.destroy', $jadwals->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus jadwal ini?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    table.dataTable td {
        white-space: normal !important;
    }
</style>

@endsection
