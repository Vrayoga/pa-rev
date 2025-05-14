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

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">SMKN 1 SUMENEP</h4>
                        <p class="card-title-desc">Edit Data Ekstrakurikuler</p>

                        <form action="{{ route('ekstrakurikuler.update', $ekstrakurikuler->id) }}" class="needs-validation" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="nama_ekstrakurikuler">Nama ekstrakurikuler</label>
                                        <input id="nama_ekstrakurikuler" name="nama_ekstrakurikuler" type="text" class="form-control" 
                                               value="{{ old('nama_ekstrakurikuler', $ekstrakurikuler->nama_ekstrakurikuler) }}" 
                                               placeholder="Masukkan Ekstrakurikuler">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="Gambar">Gambar</label>
                                        <input id="Gambar" name="Gambar" type="file" class="form-control" accept="image/*">
                                        @if($ekstrakurikuler->Gambar)
                                            <img src="{{ asset('storage/' . $ekstrakurikuler->Gambar) }}" width="100" class="mt-2">
                                            <small class="text-muted">Gambar saat ini</small>
                                        @endif
                                    </div>                    
                                    <div class="mb-3">
                                        <label for="Deskripsi">Deskripsi</label>
                                        <textarea id="Deskripsi" name="Deskripsi" class="form-control" 
                                                  placeholder="Masukkan Deskripsi ekstrakurikuler">{{ old('Deskripsi', $ekstrakurikuler->Deskripsi) }}</textarea>
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
                                        <label for="id_users" class="form-label">Pilih Guru Pembina</label>
                                        <select id="id_users" name="id_users" class="form-select" required>
                                            <option value="" disabled>-- Pilih Guru --</option>
                                            @foreach($gurus as $guru)
                                                <option value="{{ $guru->id }}" 
                                                    {{ $ekstrakurikuler->id_users == $guru->id ? 'selected' : '' }}>
                                                    {{ $guru->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_users')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">

                                    <div class="mb-3">
                                        <label for="Lokasi">Lokasi</label>
                                        <input id="Lokasi" name="Lokasi" type="text" class="form-control" 
                                               value="{{ old('Lokasi', $ekstrakurikuler->Lokasi) }}" 
                                               placeholder="Masukkan lokasi ekstrakurikuler">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="periode">Jenis Ekstrakurikuler</label>
                                        <select id="jenis" name="jenis" class="form-control">
                                            <option value="" disabled>Pilih Jenis Ekstrakurikuler</option>
                                            <option value="wajib" {{ $ekstrakurikuler->periode == 'wajib' ? 'selected' : '' }}>Wajib</option>
                                            <option value="pilihan" {{ $ekstrakurikuler->periode == 'pilihan' ? 'selected' : '' }}>Pilihan</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="kuota">kuota</label>
                                        <input id="kuota" name="kuota" type="number" class="form-control" 
                                               value="{{ old('kuota', $ekstrakurikuler->kuota) }}" 
                                               placeholder="Masukkan Jumlah ekstrakurikuler">
                                    </div>

                                     <div class="mb-3">
                                        <label for="status">Periode</label>
                                        <select id="periode" name="periode" class="form-control">
                                            <option value="" disabled selected>Pilih Status</option>
                                            <option value="aktif">Aktif</option>
                                            <option value="talkative">Tidak Aktif</option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Update Data</button>
                                <a href="{{ route('ekstrakurikuler.index') }}" class="btn btn-secondary waves-effect waves-light">Cancel</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection