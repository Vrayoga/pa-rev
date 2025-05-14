@extends('layout.MainLayout')

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Edit Logbook</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Edit</a></li>
                            <li class="breadcrumb-item active">Data logbook</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <!-- Form Edit -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">SMKN 1 SUMENEP</h4>
                        <p class="card-title-desc">Edit Data Logbook</p>

                        <form action="{{route ('logbook.update', $logbook->id)}}" class="needs-validation" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="ekstrakurikuler">Ekstrakurikuler</label>
                                        <select id="ekstrakurikuler_id" name="ekstrakurikuler_id" class="form-control">
                                            <option value="" disabled>Pilih Ekstrakurikuler</option>
                                            @foreach($ekstrakurikuler as $item)
                                                <option value="{{ $item->id }}" {{ $logbook->ekstrakurikuler_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->nama_ekstrakurikuler }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="Kegiatan">Kegiatan</label>
                                        <input id="Kegiatan" name="Kegiatan" type="text" class="form-control" value="{{ $logbook->Kegiatan }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="Tanggal">Tanggal Kegiatan</label>
                                        <input id="Tanggal" name="Tanggal" type="date" class="form-control" value="{{ $logbook->Tanggal }}">
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="Jam_mulai">Jam mulai</label>
                                        <input id="Jam_mulai" name="Jam_mulai" type="time" class="form-control" value="{{ $logbook->Jam_mulai }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="Jam_selesai">Jam selesai</label>
                                        <input id="Jam_selesai" name="Jam_selesai" type="time" class="form-control" value="{{ $logbook->Jam_selesai }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="Gambar">Gambar</label>
                                        <input id="Foto_kegiatan" name="Foto_kegiatan" type="file" class="form-control" accept="image/*">
                                        @if($logbook->Foto_kegiatan)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/'.$logbook->Foto_kegiatan) }}" width="100" class="img-thumbnail">
                                                <small class="text-muted">Gambar saat ini</small>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                                <a href="/logbook" class="btn btn-secondary waves-effect waves-light">Cancel</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
