@extends('layout.MainLayout')

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Edit Data Siswa</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('siswa.index') }}">Data Siswa</a></li>
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
                        <p class="card-title-desc">Edit data siswa</p>

                        <form action="{{ route('siswa.update', $siswa) }}" class="needs-validation" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="nama_siswa">Nama siswa</label>
                                        <input id="nama_siswa" name="nama_siswa" type="text" class="form-control" 
                                               value="{{ old('nama_siswa', $siswa->nama_siswa) }}" placeholder="Nama siswa" required>
                                        @error('nama_siswa')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="sekolah_asal">Asal Sekolah</label>
                                        <input id="sekolah_asal" name="sekolah_asal" type="text" class="form-control" 
                                               value="{{ old('sekolah_asal', $siswa->sekolah_asal) }}" placeholder="Masukkan Asal Sekolah" required>
                                    </div>
                                    
                                </div>

                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="id_kelas">Pilih kelas</label>
                                        <select id="id_kelas" name="id_kelas" class="form-control" required>
                                            <option value="" disabled>Pilih Kelas</option>
                                            @foreach($Kelas as $item)
                                                <option value="{{ $item->id }}" 
                                                    {{ $siswa->id_kelas == $item->id ? 'selected' : '' }}>
                                                    {{ $item->kelas }} - {{ $item->jurusan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nis">NIS</label>
                                        <input id="nis" name="nis" type="text" class="form-control" 
                                               value="{{ old('nis', $siswa->nis) }}" placeholder="Masukkan nis" required>
                                    </div>
                                    {{-- <div class="mb-3">
                                        <label for="image">Foto Siswa</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                        @if($siswa->image)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $siswa->image) }}" width="100" class="img-thumbnail">
                                                <small class="text-muted">Foto saat ini</small>
                                            </div>
                                        @endif
                                    </div> --}}
                                </div>
                            </div>

                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan Perubahan</button>
                                <a href="{{ route('siswa.index') }}" class="btn btn-secondary waves-effect waves-light">Batal</a>
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