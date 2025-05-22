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
                        <h4 class="mb-sm-0 font-size-18">Data Ekstrakurikuler</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Data Ekstrakurikuler</li>
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
                                <a href="/ekstrakurikuler/create"
                                    class="btn btn-primary btn-rounded waves-effect waves-light">
                                    <i class="mdi mdi-plus me-1"> Tambah Data Ekstrakurikuler </i>
                                </a>
                            </div>

                            <h4 class="card-title">Table Ekstrakurikuler</h4>
                            @if ($ekstrakurikulers->isEmpty() && $user->hasRole('guru'))
                                <div class="alert alert-warning">
                                    Anda masih belum mengampu ekstrakurikuler.
                                </div>
                                @else
                                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">No</th>
                                            <th>Nama Ekstrakurikuler</th>
                                            <th>Gambar</th>
                                            <th>Deskripsi</th>
                                            <th>Kategori</th>
                                            <th>Lokasi</th>
                                            <th>Jadwal</th>
                                            <th>Jam Mulai</th>
                                            <th>Jam Selesai</th>
                                            <th>Periode</th>
                                            <th>Jenis</th>
                                            <th>Kuota</th>
                                            <th>Guru Pembimbing</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ekstrakurikulers as $index => $ekstrakurikuler)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $ekstrakurikuler->nama_ekstrakurikuler }}</td>
                                                <td>
                                                    @if ($ekstrakurikuler->gambar)
                                                         <img src="{{ Storage::url($ekstrakurikuler->gambar) }}" 
                                                            alt="Gambar" width="50">
                                                    @else
                                                       {{ $ekstrakurikuler->gambar }}
                                                        <span class="text-danger">N/A</span>
                                                    @endif
                                                </td>
                                                <td>{{ $ekstrakurikuler->deskripsi }}</td>
                                                <td>{{ $ekstrakurikuler->kategori->nama_kategori }}</td>
                                                <td>{{ $ekstrakurikuler->lokasi }}</td>

                                                @php $jadwals = $ekstrakurikuler->jadwals; @endphp
                                                <td>
                                                    @if ($jadwals->isEmpty())
                                                        <span class="text-danger">N/A</span>
                                                    @else
                                                        @foreach ($jadwals as $jadwal)
                                                            {{ ucfirst($jadwal->hari) }}<br>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($jadwals->isEmpty())
                                                        <span class="text-danger">N/A</span>
                                                    @else
                                                        @foreach ($jadwals as $jadwal)
                                                            {{ $jadwal->jam_mulai }}<br>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($jadwals->isEmpty())
                                                        <span class="text-danger">N/A</span>
                                                    @else
                                                        @foreach ($jadwals as $jadwal)
                                                            {{ $jadwal->jam_selesai }}<br>
                                                        @endforeach
                                                    @endif
                                                </td>

                                                <td>{{ $ekstrakurikuler->periode }}</td>
                                                <td>{{ $ekstrakurikuler->jenis }}</td>
                                                <td>{{ $ekstrakurikuler->kuota }}</td>
                                                <td>{{ $ekstrakurikuler->user->name }}</td>
                                                <td>
                                                    @can('edit ekstrakurikuler')
                                                        <a href="{{ route('ekstrakurikuler.edit', $ekstrakurikuler->id) }}"
                                                            class="btn btn-warning btn-sm">Edit</a>
                                                    @endcan

                                                    {{-- <a href="{{ route('ekstrakurikuler.show', $ekstrakurikuler->id) }}" class="btn btn-info btn-sm">Detail</a> --}}
                                                    @can('delete ekstrakurikuler')
                                                        <form
                                                            action="{{ route('ekstrakurikuler.destroy', $ekstrakurikuler->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure?')">Delete</button>
                                                        </form>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    @endif
                                </table>



                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
    <style>
        table.dataTable td {
            white-space: normal !important;
        }
    </style>

@endsection
