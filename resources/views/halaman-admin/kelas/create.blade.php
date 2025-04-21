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
                            <li class="breadcrumb-item active">Data kelas</li>
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
                        <p class="card-title-desc">Data Kelas</p>

                        <form action="/kelas-store" class="needs-validation" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="kelas">Kelas</label>
                                        <select id="kelas" name="kelas" class="form-control">
                                            <option value="" disabled selected>Pilih Kelas</option>
                                            <option value="X">X</option>
                                            <option value="XI">XI</option>
                                            <option value="XII">XII</option>
                                        </select>
                                    </div>
                                  
                                </div>

                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="manufacturername">Jurusan</label>
                                        <input id="sekolah_asal" name="sekolah_asal" type="text" class="form-control" placeholder="Masukkan Asal Sekolah">
                                        <div class="invalid-feedback">Masukkan jurusan.</div>
                                    </div>
                                </div>
                            </div>

                         
                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save Changes</button>
                                <a href="/kelas" class="btn btn-secondary waves-effect waves-light">Cancel</a>
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
