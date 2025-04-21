@extends('layout.MainLayout')

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Data logbook</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Create</a></li>
                            <li class="breadcrumb-item active">Data logbook</li>
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
                        <p class="card-title-desc">Data Logbook</p>

                        <form action="/logbook-store" class="needs-validation" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="ekstrakurikuler">Ekstrakurikuler</label>
                                        <select id="ekstrakurikuler_id" name="ekstrakurikuler_id" class="form-control">
                                            <option value="" disabled selected>Pilih Ekstrakurikuler</option>
                                            @foreach($ekstrakurikuler as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_ekstrakurikuler }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="manufacturername">Kegiatan</label>
                                        <input id="Kegiatan" name="Kegiatan" type="text" class="form-control" placeholder="Masukkan Kegiatan">
                                    </div>
                                    <div class="mb-3">
                                        <label for="manufacturername">Tanggal Kegiatan</label>
                                        <input id="Tanggal" name="Tanggal" type="date" class="form-control" placeholder="Masukkan Tanggal Kegiatan">
                                    </div>
                                    
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="manufacturername">Jam mulai</label>
                                        <input id="Jam_mulai" name="Jam_mulai" type="time" class="form-control" placeholder="Masukkan jam mulai">
                                    </div>
                                    <div class="mb-3">
                                        <label for="manufacturername">Jam selesai</label>
                                        <input id="Jam_selesai" name="Jam_selesai" type="time" class="form-control" placeholder="Masukkan jam selesai">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="manufacturername">Foto kegiatan</label>
                                        <input id="Foto_kegiatan" name="Foto_kegiatan" type="file" class="form-control" placeholder="Masukkan jam selesai">
                                    </div>
                                </div>
                            </div>

                         
                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save Changes</button>
                                <a href="/logbook" class="btn btn-secondary waves-effect waves-light">Cancel</a>
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
