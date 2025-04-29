@extends('layout.MainLayout')

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
                                <a href="/ekstrakurikuler/create" class="btn btn-primary btn-rounded waves-effect waves-light">
                                    <i class="mdi mdi-plus me-1"> Tambah Data Ekstrakurikuler </i>
                                </a>
                            </div>
                            
                            <h4 class="card-title">Table Ekstrakurikuler</h4>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th>Nama Ekstrakurikuler</th>
                                    <th>Gambar</th>
                                    <th>Jadwal</th>
                                    <th>Deskripsi</th>
                                    <th>Kategori</th>
                                    <th>Jam mulai</th>
                                    <th>Jam selesai</th>
                                    <th>Lokasi</th>
                                    <th>Periode</th>
                                    <th>jenis</th>
                                    <th>stok</th>
                                    <th>guru pembimbing</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                    @foreach($ekstrakurikulers as $index => $ekstrakurikuler)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $ekstrakurikuler->nama_ekstrakurikuler }}</td>
                                        <td>
                                            @if($ekstrakurikuler->Gambar)
                                                <img src="{{ asset('storage/' . $ekstrakurikuler->Gambar) }}" alt="Gambar" width="50">
                                            @else
                                                Tidak ada gambar
                                            @endif
                                        </td>
                                        <td>{{ $ekstrakurikuler->Jadwal }}</td>
                                        <td>{{ $ekstrakurikuler->Deskripsi }}</td>
                                        <td>{{ $ekstrakurikuler->kategori }}</td>
                                        <td>{{ $ekstrakurikuler->Jam_mulai }}</td>
                                        <td>{{ $ekstrakurikuler->Jam_selesai }}</td>
                                        <td>{{ $ekstrakurikuler->Lokasi }}</td>
                                        <td>{{ $ekstrakurikuler->Periode }}</td>
                                        <td>{{ $ekstrakurikuler->jenis }}</td>
                                        <td>{{ $ekstrakurikuler->stok }}</td>
                                        <td>{{ $ekstrakurikuler->user_name }}</td>
                                        <td>
                                            @can('edit ekstrakurikuler')
                                            <a href="{{route ('ekstrakurikuler.edit', $ekstrakurikuler->id )}}" class="btn btn-warning btn-sm">Edit</a>
                                            @endcan
                                            <form action="{{route ('ekstrakurikuler.destroy', $ekstrakurikuler->id)}}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
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
    <style>
        table.dataTable td {
            white-space: normal !important;
        }
    </style>
    
@endsection
