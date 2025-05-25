@extends('layout.MainLayout')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- Judul Halaman -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Tambah Prestasi</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Prestasi</a></li>
                                <li class="breadcrumb-item active">Tambah</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Input -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Input Prestasi Siswa / Alumni</h4>

                           
                            <form action="{{ route('prestasi.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation">
                                @csrf
                                <div class="row">
                                    <!-- Kolom Kiri -->
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="mode">Pilih Jenis Pengisian</label>
                                            <select name="mode" id="mode" class="form-control" onchange="toggleMode()" required>
                                                <option value="" disabled selected>Pilih Mode</option>
                                                <option value="aktif">Siswa Aktif (Pendaftaran)</option>
                                                <option value="alumni">Alumni</option>
                                            </select>
                                        </div>

                                        <!-- Untuk Siswa Aktif -->
                                        <div id="aktifFields" style="display: none;">
                                            <div class="mb-3">
                                                <label for="pendaftaran_id">Pilih Siswa Aktif (Berdasarkan Pendaftaran)</label>
                                                <select name="pendaftaran_id" id="pendaftaran_id" class="form-control">
                                                    <option value="" disabled selected>Pilih Siswa</option>
                                                    @foreach ($pendaftarans as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->siswa->nama_siswa }} - {{ $item->ekstrakurikuler->nama_ekstrakurikuler }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Untuk Alumni -->
                                        <div id="alumniFields" style="display: none;">
                                            <div class="mb-3">
                                                <label for="siswa_id">Pilih Alumni</label>
                                                <select name="siswa_id" id="siswa_id" class="form-control">
                                                    <option value="">Pilih Siswa</option>
                                                    @foreach ($siswas as $s)
                                                        <option value="{{ $s->id }}">{{ $s->nama_siswa }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="ekstrakurikuler_id">Pilih Ekstrakurikuler</label>
                                                <select name="ekstrakurikuler_id" class="form-control">
                                                    <option value="" disabled selected>Pilih Ekstrakurikuler</option>
                                                    @foreach ($ekstrakurikulers as $ekstra)
                                                        <option value="{{ $ekstra->id }}">{{ $ekstra->nama_ekstrakurikuler }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="nama_kegiatan">Nama Kegiatan</label>
                                            <input type="text" name="nama_kegiatan" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="peringkat">Peringkat</label>
                                            <input type="text" name="peringkat" class="form-control" required>
                                        </div>
                                    </div>

                                    <!-- Kolom Kanan -->
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="tanggal_kejuaraan">Tanggal Kejuaraan</label>
                                            <input type="date" name="tanggal_kejuaraan" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="tingkat_kejuaraan">Tingkat Kejuaraan</label>
                                            <input type="text" name="tingkat_kejuaraan" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="deskripsi">Deskripsi (Opsional)</label>
                                            <textarea name="deskripsi" class="form-control" rows="4"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="foto_prestasi">Foto Prestasi</label>
                                            <input type="file" name="foto_prestasi" class="form-control" accept="image/*" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap gap-2">
                                    <button type="submit" class="btn btn-primary">Simpan Prestasi</button>
                                    <a href="{{ route('prestasi.index') }}" class="btn btn-secondary">Batal</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function toggleMode() {
            let mode = document.getElementById("mode").value;
            document.getElementById("aktifFields").style.display = (mode === "aktif") ? "block" : "none";
            document.getElementById("alumniFields").style.display = (mode === "alumni") ? "block" : "none";
            
            // Initialize select2 when fields are shown
            if (mode === "aktif") {
                initializePendaftaranSelect2();
            } else if (mode === "alumni") {
                initializeSiswaSelect2();
            }
        }

        function initializePendaftaranSelect2() {
            $('#pendaftaran_id').select2({
                placeholder: "Cari nama siswa aktif...",
                allowClear: true,
                width: '100%',
                minimumInputLength: 1,
                matcher: function(params, data) {
                    // If there are no search terms, return all data
                    if ($.trim(params.term) === '') {
                        return data;
                    }

                    // Check if the text contains the term
                    if (data.text.toLowerCase().indexOf(params.term.toLowerCase()) > -1) {
                        return data;
                    }

                    // Return `null` if the term should not be displayed
                    return null;
                }
            });
        }

        function initializeSiswaSelect2() {
            $('#siswa_id').select2({
                placeholder: "Cari nama alumni...",
                allowClear: true,
                width: '100%',
                minimumInputLength: 1,
                matcher: function(params, data) {
                    // If there are no search terms, return all data
                    if ($.trim(params.term) === '') {
                        return data;
                    }

                    // Check if the text contains the term
                    if (data.text.toLowerCase().indexOf(params.term.toLowerCase()) > -1) {
                        return data;
                    }

                    // Return `null` if the term should not be displayed
                    return null;
                }
            });
        }

        $(document).ready(function() {
            // Initialize ekstrakurikuler select2
            $('select[name="ekstrakurikuler_id"]').select2({
                placeholder: "Pilih Ekstrakurikuler",
                allowClear: true,
                width: '100%'
            });

            // Initialize mode select2
            $('#mode').select2({
                placeholder: "Pilih Mode",
                allowClear: false,
                width: '100%'
            });
        });
    </script>

    <style>
        /* Custom styling for select2 */
        .select2-container--default .select2-selection--single {
            height: 38px;
            line-height: 38px;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            padding-left: 12px;
            padding-right: 20px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
            right: 10px;
        }

        .select2-dropdown {
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        .select2-search--dropdown .select2-search__field {
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }
    </style>
@endsection