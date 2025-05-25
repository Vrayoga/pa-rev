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
                            <li class="breadcrumb-item active">Data Ekstrakurikuler</li>
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
                        <p class="card-title-desc">Data Ekstrakurikuler</p>

                        <form action="{{route ('ekstrakurikuler.store')}}" class="needs-validation" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="manufacturername">Nama ekstrakurikuler</label>
                                        <input id="nama_ekstrakurikuler" name="nama_ekstrakurikuler" type="text" class="form-control" placeholder="Masukkan Ekstrakurikuler">
                                        
                                    </div>
                                    <div class="mb-3">
                                        <label for="gambar">Gambar</label>
                                        <input id="Gambar" name="Gambar" type="file" class="form-control" accept="image/*">
                                    </div>
                                    <div class="mb-3">
                                        <label for="manufacturername">Deskripsi</label>
                                        <textarea id="Deskripsi" name="Deskripsi" class="form-control" placeholder="Masukkan Deskripsi ekstrakurikuler" rows="4"></textarea>
                                    </div>
                                  
                                    <div class="mb-3">
                                        <label for="id_kategori">Kategori</label>
                                        <select id="id_kategori" name="id_kategori" class="form-control">
                                            <option value="" disabled selected>Pilih Kategori</option>
                                            @foreach($kategori as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="manufacturername">Lokasi</label>
                                        <input id="Lokasi" name="Lokasi" type="text" class="form-control" placeholder="Masukkan lokasi ekstrakurikuler">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="id_kategori">Pilih guru</label>
                                        <select id="id_users" name="id_users" class="form-control">
                                            <option value="" disabled selected>Pilih Guru</option>
                                            @foreach($gurus as $guru)
                                            <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status">jenis Ekstrakurikuler</label>
                                        <select id="jenis" name="jenis" class="form-control">
                                            <option value="" disabled selected>Pilih Jenis Ekstrakurikuler</option>
                                            <option value="wajib">wajib</option>
                                            <option value="pilihan">pilihan</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="manufacturername">kuota</label>
                                        <input id="kuota" name="kuota" type="text" class="form-control" placeholder="Masukkan Jumlah ekstrakurikuler">
                                        
                                    </div>
                                </div>
                            </div>

                         
                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save Changes</button>
                                <a href="/ekstrakurikuler" class="btn btn-secondary waves-effect waves-light">Cancel</a>
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
