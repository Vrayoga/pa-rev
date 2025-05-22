@extends('layout.MainLayout')

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Data Jadwal</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Create</a></li>
                            <li class="breadcrumb-item active">Data Jadwal </li>
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
                        <p class="card-title-desc">Data Jadwal Ekstrakurikuler</p>

                        @php
                            $user = auth()->user();
                        @endphp

                        <form action="{{ route('jadwal.store') }}" class="needs-validation" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="ekstrakurikuler_id">Ekstrakurikuler</label>
                                        @if($user->hasRole('guru_pembina'))
                                            {{-- Guru hanya bisa pilih dari ekstrakurikuler yang dia ampu --}}
                                            <select id="ekstrakurikuler_id" name="ekstrakurikuler_id" class="form-control">
                                                <option value="" disabled selected>Pilih Ekstrakurikuler</option>
                                                @foreach($ekstrakurikuler as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_ekstrakurikuler }}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select id="ekstrakurikuler_id" name="ekstrakurikuler_id" class="form-control">
                                                <option value="" disabled selected>Pilih Ekstrakurikuler</option>
                                                @foreach($ekstrakurikuler as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_ekstrakurikuler }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label for="hari">Hari</label>
                                        <select id="hari" name="hari" class="form-control">
                                            <option value="" disabled selected>Pilih Hari</option>
                                            <option value="senin">Senin</option>
                                            <option value="selasa">Selasa</option>
                                            <option value="rabu">Rabu</option>
                                            <option value="kamis">Kamis</option>
                                            <option value="jumat">Jumat</option>
                                            <option value="sabtu">Sabtu</option>
                                            <option value="minggu">Minggu</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="jam_mulai">Jam Mulai</label>
                                        <input id="jam_mulai" name="jam_mulai" type="time" class="form-control" placeholder="Jam mulai kegiatan">
                                    </div>
                                    <div class="mb-3">
                                        <label for="jam_selesai">Jam Selesai</label>
                                        <input id="jam_selesai" name="jam_selesai" type="time" class="form-control" placeholder="Jam selesai kegiatan">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save Changes</button>
                                <a href="/jadwal" class="btn btn-secondary waves-effect waves-light">Cancel</a>
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
