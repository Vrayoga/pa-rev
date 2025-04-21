@extends('layout.MainLayout')

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Edit Data Kelas</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('kelas.index') }}">Data Kelas</a></li>
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
                        <p class="card-title-desc">Edit data kelas</p>

                        <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="kelas">Kelas</label>
                                        <select id="kelas" name="kelas" class="form-control" required>
                                            <option value="" disabled>Pilih Kelas</option>
                                            <option value="X" {{ $kelas->kelas == 'X' ? 'selected' : '' }}>X</option>
                                            <option value="XI" {{ $kelas->kelas == 'XI' ? 'selected' : '' }}>XI</option>
                                            <option value="XII" {{ $kelas->kelas == 'XII' ? 'selected' : '' }}>XII</option>
                                        </select>
                                        @error('kelas')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="jurusan">Jurusan</label>
                                        <input id="jurusan" name="jurusan" type="text" class="form-control" 
                                               value="{{ old('jurusan', $kelas->jurusan) }}" placeholder="Masukkan Jurusan" required>
                                        @error('jurusan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan Perubahan</button>
                                <a href="/kelas" class="btn btn-secondary waves-effect waves-light">Batal</a>
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