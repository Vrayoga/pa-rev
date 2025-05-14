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
                                            <label for="tingkat">Tingkat Kelas</label>
                                            <select id="tingkat" name="tingkat" class="form-control" required>
                                                <option value="X" {{ $kelas->tingkat == 'X' ? 'selected' : '' }}>X
                                                </option>
                                                <option value="XI" {{ $kelas->tingkat == 'XI' ? 'selected' : '' }}>XI
                                                </option>
                                                <option value="XII" {{ $kelas->tingkat == 'XII' ? 'selected' : '' }}>XII
                                                </option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="id_jurusan">Jurusan</label>
                                            <select id="id_jurusan" name="id_jurusan" class="form-control" required>
                                                @foreach ($jurusan as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $kelas->id_jurusan == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama_jurusan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        
                                        <div class="mb-3">
                                        <label for="kode_kelas">Kode Kelas</label>
                                        <input id="kode_kelas" name="kode_kelas" type="text" class="form-control"
                                            value="{{ $kelas->kode_kelas }}" required>
                                    </div>
                                    </div>
                                </div>

                                

                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div>
    </div>
@endsection
