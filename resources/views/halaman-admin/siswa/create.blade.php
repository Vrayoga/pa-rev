@extends('layout.MainLayout')

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Data siswa</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Create</a></li>
                            <li class="breadcrumb-item active">Data siswa</li>
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
                        <p class="card-title-desc">Data siswa</p>

                        <form action="{{route ('siswa.store' )}}" class="needs-validation" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="productname">Nama siswa</label>
                                        <input id="nama_siswa" name="nama_siswa" type="text" class="form-control" placeholder="Nama siswa">
                                    </div>
                                    <div class="mb-3">
                                        <label for="manufacturername">Asal Sekolah</label>
                                        <input id="sekolah_asal" name="sekolah_asal" type="text" class="form-control" placeholder="Masukkan Asal Sekolah">
                                    </div>
                                    
                                </div>

                                <div class="col-sm-6">
                                    {{-- <div class="mb-3">
                                        <label for="manufacturerbrand">alamat </label>
                                        <input id="alamat" name="alamat" type="text" class="form-control" placeholder="Masukkan alamat">
                                    </div> --}}
                                    <div class="mb-3">
                                        <label for="id_kelas">Pilih kelas</label>
                                        <select id="id_kelas" name="id_kelas" class="form-control">
                                            <option value="" disabled selected>Pilih Kelas</option>
                                            @foreach($Kelas as $item)
                                                <option value="{{ $item->id }}">{{ $item->kelas }} - {{ $item->jurusan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price">Nis</label>
                                        <input id="nis" name="nis" type="text" class="form-control" placeholder="Masukkan nis">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save Changes</button>
                                <a href="/siswa" class="btn btn-secondary waves-effect waves-light">Cancel</a>
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
