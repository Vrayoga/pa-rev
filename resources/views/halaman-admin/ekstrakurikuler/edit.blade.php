@extends('layout.MainLayout')

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Edit Data Ekstrakurikuler</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ekstrakurikuler</a></li>
                            <li class="breadcrumb-item active">Edit Data</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">SMKN 1 SUMENEP</h4>
                        <p class="card-title-desc">Edit Data Ekstrakurikuler</p>

                        <form action="{{route ('ekstrakurikuler.update', $ekstrakurikuler->id)}}" class="needs-validation" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="nama_ekstrakurikuler">Nama ekstrakurikuler</label>
                                        <input id="nama_ekstrakurikuler" name="nama_ekstrakurikuler" type="text" class="form-control" 
                                               value="{{ old('nama_ekstrakurikuler', $ekstrakurikuler->nama_ekstrakurikuler) }}" placeholder="Masukkan Ekstrakurikuler">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Gambar">Gambar</label>
                                        <input id="Gambar" name="Gambar" type="file" class="form-control" accept="image/*">
                                        @if($ekstrakurikuler->Gambar)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/'.$ekstrakurikuler->Gambar) }}" width="100" class="img-thumbnail">
                                                <small class="text-muted">Gambar saat ini</small>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="Jadwal">Jadwal</label>
                                        <input id="Jadwal" name="Jadwal" type="text" class="form-control" 
                                               value="{{ old('Jadwal', $ekstrakurikuler->Jadwal) }}" placeholder="Masukkan Jadwal ekstrakurikuler">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Deskripsi">Deskripsi</label>
                                        <input id="Deskripsi" name="Deskripsi" type="text" class="form-control" 
                                               value="{{ old('Deskripsi', $ekstrakurikuler->Deskripsi) }}" placeholder="Masukkan Deskripsi ekstrakurikuler">
                                    </div>
                                   
                                </div>

                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="Jam_mulai">Jam mulai</label>
                                        <input id="Jam_mulai" name="Jam_mulai" type="time" class="form-control" 
                                               value="{{ old('Jam_mulai', $ekstrakurikuler->Jam_mulai) }}" placeholder="Jam mulai kegiatan">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Jam_selesai">Jam selesai</label>
                                        <input id="Jam_selesai" name="Jam_selesai" type="time" class="form-control" 
                                               value="{{ old('Jam_selesai', $ekstrakurikuler->Jam_selesai) }}" placeholder="Jam selesai kegiatan">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Lokasi">Lokasi</label>
                                        <input id="Lokasi" name="Lokasi" type="text" class="form-control" 
                                               value="{{ old('Lokasi', $ekstrakurikuler->Lokasi) }}" placeholder="Masukkan lokasi ekstrakurikuler">
                                    </div>
                                    <div class="mb-3">
                                        <label for="id_kategori">Kategori</label>
                                        <select id="id_kategori" name="id_kategori" class="form-control">
                                            <option value="" disabled>Pilih Kategori</option>
                                            @foreach($kategori as $item)
                                                <option value="{{ $item->id }}" 
                                                    {{ $ekstrakurikuler->id_kategori == $item->id ? 'selected' : '' }}>
                                                    {{ $item->nama_kategori }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="periode">Status</label>
                                        <select id="periode" name="periode" class="form-control">
                                            <option value="" disabled>Pilih Status</option>
                                            <option value="aktif" {{ $ekstrakurikuler->periode == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="tidak_aktif" {{ $ekstrakurikuler->periode == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan Perubahan</button>
                                <a href="/ekstrakurikuler" class="btn btn-secondary waves-effect waves-light">Batal</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

    </div>
</div>
@endsection