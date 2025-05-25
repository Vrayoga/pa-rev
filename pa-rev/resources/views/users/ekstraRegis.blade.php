@extends('layout.MainLayout')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- Premium Registration Header -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h1 class="text-gradient display-5">Pendaftaran Ekstrakurikuler</h1>
                            <p class="lead text-muted">Bergabunglah dengan kegiatan ekstrakurikuler pilihan Anda (maksimal 2)
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('userSiswa.index') }}" class="btn btn-light">
                                <i class="mdi mdi-arrow-left me-1"></i> Kembali ke Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alert Section -->
            @if (session('error'))
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-alert-circle-outline me-3" style="font-size: 24px"></i>
                                <div>
                                    <h5 class="alert-heading">Terjadi Kesalahan</h5>
                                    <p class="mb-0">{{ session('error') }}</p>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('warning'))
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-alert me-3" style="font-size: 24px"></i>
                                <div>
                                    <h5 class="alert-heading">Perhatian</h5>
                                    <p class="mb-0">{{ session('warning') }}</p>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-check-circle-outline me-3" style="font-size: 24px"></i>
                                <div>
                                    <h5 class="alert-heading">Berhasil!</h5>
                                    <p class="mb-0">{{ session('success') }}</p>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Pending Registrations Section (if any) -->
            @if (isset($pendingRegistrations) && $pendingRegistrations->isNotEmpty())
                <div class="row mb-5">
                    <div class="col-12">
                        <div class="card premium-card">
                            <div class="card-header bg-warning bg-opacity-10">
                                <h3 class="card-title mb-0">
                                    <i class="mdi mdi-clock-outline me-2"></i> Pendaftaran Menunggu Validasi
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="pending-list">
                                    @foreach ($pendingRegistrations as $pending)
                                        <div class="pending-item">
                                            <div class="pending-icon">
                                                <i class="mdi mdi-clock-outline"></i>
                                            </div>
                                            <div class="pending-details">
                                                <h5>{{ $pending->ekstrakurikuler->nama_ekstrakurikuler }}</h5>
                                                <p class="text-muted mb-2">Tanggal Pendaftaran:
                                                    {{ $pending->created_at->format('d F Y H:i') }}</p>
                                                <span class="badge bg-warning text-dark">
                                                    <i class="mdi mdi-loading mdi-spin me-1"></i> Menunggu Validasi
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                @php
                                    $pendingCount = $pendingRegistrations->count();
                                    $canRegisterMore = $pendingCount < 2;
                                @endphp

                                @if ($canRegisterMore)
                                    <div class="alert alert-info mt-4">
                                        <i class="mdi mdi-information-outline me-2"></i>
                                        Anda masih dapat mendaftar {{ 2 - $pendingCount }} ekstrakurikuler lagi.
                                    </div>
                                @else
                                    <div class="alert alert-warning mt-4">
                                        <i class="mdi mdi-information-outline me-2"></i>
                                        Anda telah mendaftar 2 ekstrakurikuler (batas maksimal). Tidak dapat mendaftar lagi
                                        sampai salah satu pendaftaran ditolak.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- No Ekstrakurikuler Available -->
            @if ($ekstrakurikulers->isEmpty())
                <div class="row mb-5">
                    <div class="col-12">
                        <div class="card premium-card">
                            <div class="card-body text-center py-5">
                                <i class="mdi mdi-information-outline text-muted" style="font-size: 64px"></i>
                                <h3 class="mt-3">Tidak Ada Ekstrakurikuler Tersedia</h3>
                                <p class="text-muted">Saat ini tidak ada ekstrakurikuler yang terbuka untuk pendaftaran.</p>
                                <a href="{{ route('userSiswa.index') }}" class="btn btn-primary mt-3">
                                    <i class="mdi mdi-arrow-left me-1"></i> Kembali ke Dashboard
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Show Registration Form when no pending registrations or max not reached -->
            @elseif(!isset($pendingRegistrations) || $pendingRegistrations->count() < 2)
                <!-- Registration Form Section -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card premium-card">
                            <div class="card-header">
                                <h3 class="card-title mb-0">
                                    <i class="mdi mdi-pencil-box-outline me-2"></i> Formulir Pendaftaran
                                </h3>
                            </div>
                            <div class="card-body">
                                @php
                                    // Check if there's already one pending registration
$existingPendingCount = isset($pendingRegistrations)
    ? $pendingRegistrations->count()
    : 0;
$registeredEkstrasIds = isset($registeredEkstras) ? $registeredEkstras : [];

// If we already have a pending registration, we'll only show the second form
                                    $showFirstForm = $existingPendingCount == 0;
                                    $showSecondForm = true;
                                @endphp

                                <form id="pendaftaranForm" action="{{ route('ekstraDaftar.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" value="{{ Auth::user()->name }}"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Kelas</label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::user()->kelas_siswa->nama_kelas ?? '-' }}" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="nomer_wali" class="form-label">Nomor Telepon Wali <span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('nomer_wali') is-invalid @enderror" id="nomer_wali"
                                            name="nomer_wali" placeholder="Masukkan nomor telepon wali murid"
                                            value="{{ old('nomer_wali') }}" required>
                                        <small class="text-muted">Format: 628xxxxxxxxxx (tanpa tanda + atau -)</small>
                                        @error('nomer_wali')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Ekstrakurikuler 1 - Show only if no pending registrations -->
                                    @if ($showFirstForm)
                                        <div class="card mb-4 border-primary bg-light bg-opacity-10">
                                            <div class="card-header bg-primary bg-opacity-10">
                                                <h5 class="mb-0">Pilihan Ekstrakurikuler 1 <span
                                                        class="text-danger">*</span></h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-4">
                                                    <label for="ekstrakurikuler_id_1" class="form-label">Ekstrakurikuler
                                                        <span class="text-danger">*</span></label>
                                                    <select
                                                        class="form-select select2 @error('ekstrakurikuler_id_1') is-invalid @enderror"
                                                        id="ekstrakurikuler_id_1" name="ekstrakurikuler_id_1" required>
                                                        <option value="" disabled selected>Pilih Ekstrakurikuler
                                                        </option>
                                                        @foreach ($ekstrakurikulers as $ekstra)
                                                            @php
                                                                $isRegistered = in_array(
                                                                    $ekstra->id,
                                                                    $registeredEkstrasIds,
                                                                );
                                                                $pendaftarDiterima = App\Models\Pendaftaran::where(
                                                                    'ekstrakurikuler_id',
                                                                    $ekstra->id,
                                                                )
                                                                    ->where('status_validasi', 'diterima')
                                                                    ->count();
                                                                $sisaKuota =
                                                                    $ekstra->jenis == 'wajib'
                                                                        ? 'Tak Terbatas'
                                                                        : ($ekstra->kuota === null
                                                                            ? 'Tak Terbatas'
                                                                            : $ekstra->kuota - $pendaftarDiterima);
                                                            @endphp
                                                            <option value="{{ $ekstra->id }}"
                                                                data-jenis="{{ $ekstra->jenis }}"
                                                                data-kuota="{{ $sisaKuota }}"
                                                                data-pembina="{{ $ekstra->pembina->name ?? 'Belum ada pembina' }}"
                                                                data-deskripsi="{{ $ekstra->deskripsi ?? 'Tidak ada deskripsi' }}"
                                                                {{ $isRegistered ? 'disabled' : '' }}
                                                                {{ old('ekstrakurikuler_id_1') == $ekstra->id ? 'selected' : '' }}>
                                                                {{ $ekstra->nama_ekstrakurikuler }}
                                                                ({{ ucfirst($ekstra->jenis) }})
                                                                - Kuota:
                                                                {{ is_numeric($sisaKuota) ? $sisaKuota : $sisaKuota }}
                                                                {{ $isRegistered ? '(Sudah Terdaftar)' : '' }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('ekstrakurikuler_id_1')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="alasan_1" class="form-label">Alasan Bergabung</label>
                                                    <textarea class="form-control @error('alasan_1') is-invalid @enderror" id="alasan_1" name="alasan_1" rows="3"
                                                        placeholder="Jelaskan alasan Anda ingin bergabung dengan ekstrakurikuler ini (opsional)">{{ old('alasan_1') }}</textarea>
                                                    @error('alasan_1')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Ekstrakurikuler 2 -->
                                    @if ($showSecondForm)
                                        <div class="card mb-4 border-success bg-light bg-opacity-10">
                                            <div
                                                class="card-header bg-success bg-opacity-10 d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0">
                                                    @if (!$showFirstForm)
                                                        Pilihan Ekstrakurikuler <span class="text-danger">*</span>
                                                    @else
                                                        Pilihan Ekstrakurikuler 2 <span
                                                            class="text-muted">(Opsional)</span>
                                                    @endif
                                                </h5>
                                                @if ($showFirstForm)
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="toggleEkstra2"
                                                            {{ old('ekstrakurikuler_id_2') ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="toggleEkstra2">Aktifkan</label>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="card-body" id="ekstra2Section"
                                                style="{{ !$showFirstForm || old('ekstrakurikuler_id_2') ? '' : 'display: none;' }}">
                                                <div class="mb-4">
                                                    <label for="ekstrakurikuler_id_2" class="form-label">
                                                        Ekstrakurikuler
                                                        @if (!$showFirstForm)
                                                            <span class="text-danger">*</span>
                                                        @endif
                                                    </label>
                                                    <select
                                                        class="form-select select2 @error('ekstrakurikuler_id_2') is-invalid @enderror"
                                                        id="ekstrakurikuler_id_2" name="ekstrakurikuler_id_2"
                                                        {{ !$showFirstForm ? 'required' : '' }}>
                                                        <option value="" {{ $showFirstForm ? 'selected' : '' }}>
                                                            Pilih Ekstrakurikuler</option>
                                                        @foreach ($ekstrakurikulers as $ekstra)
                                                            @php
                                                                $isRegistered = in_array(
                                                                    $ekstra->id,
                                                                    $registeredEkstrasIds,
                                                                );
                                                                $pendaftarDiterima = App\Models\Pendaftaran::where(
                                                                    'ekstrakurikuler_id',
                                                                    $ekstra->id,
                                                                )
                                                                    ->where('status_validasi', 'diterima')
                                                                    ->count();
                                                                $sisaKuota =
                                                                    $ekstra->jenis == 'wajib'
                                                                        ? 'Tak Terbatas'
                                                                        : ($ekstra->kuota === null
                                                                            ? 'Tak Terbatas'
                                                                            : $ekstra->kuota - $pendaftarDiterima);
                                                            @endphp
                                                            <option value="{{ $ekstra->id }}"
                                                                data-jenis="{{ $ekstra->jenis }}"
                                                                data-kuota="{{ $sisaKuota }}"
                                                                data-pembina="{{ $ekstra->pembina->name ?? 'Belum ada pembina' }}"
                                                                data-deskripsi="{{ $ekstra->deskripsi ?? 'Tidak ada deskripsi' }}"
                                                                {{ $isRegistered ? 'disabled' : '' }}
                                                                {{ old('ekstrakurikuler_id_2') == $ekstra->id ? 'selected' : '' }}>
                                                                {{ $ekstra->nama_ekstrakurikuler }}
                                                                ({{ ucfirst($ekstra->jenis) }})
                                                                - Kuota:
                                                                {{ is_numeric($sisaKuota) ? $sisaKuota : $sisaKuota }}
                                                                {{ $isRegistered ? '(Sudah Terdaftar)' : '' }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('ekstrakurikuler_id_2')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="alasan_2" class="form-label">Alasan Bergabung</label>
                                                    <textarea class="form-control @error('alasan_2') is-invalid @enderror" id="alasan_2" name="alasan_2" rows="3"
                                                        placeholder="Jelaskan alasan Anda ingin bergabung dengan ekstrakurikuler ini (opsional)">{{ old('alasan_2') }}</textarea>
                                                    @error('alasan_2')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="alert alert-info">
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-information-outline me-3" style="font-size: 24px"></i>
                                            <div>
                                                <h5 class="alert-heading">Informasi Pendaftaran</h5>
                                                <p class="mb-0">
                                                    @if ($showFirstForm)
                                                        Anda dapat memilih maksimal 2 ekstrakurikuler. Pilihan pertama wajib
                                                        diisi, sedangkan pilihan kedua bersifat opsional.
                                                    @else
                                                        Anda sudah memiliki satu pendaftaran yang menunggu validasi. Anda
                                                        masih dapat mendaftar 1 ekstrakurikuler lagi.
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-5">
                                        <a href="{{ route('userSiswa.index') }}" class="btn btn-light">
                                            <i class="mdi mdi-arrow-left me-1"></i> Kembali
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="mdi mdi-send me-1"></i> Kirim Pendaftaran
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Ekstrakurikuler Details Section -->
                    <div class="col-lg-4">
                        <div class="card premium-card sticky-top" style="top: 20px;">
                            <div class="card-header">
                                <h3 class="card-title mb-0">
                                    <i class="mdi mdi-information-outline me-2"></i> Informasi Ekstrakurikuler
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="text-center mb-4" id="ekstraImagePreview">
                                    <img src="{{ asset('assets/images/ekstra/default.jpg') }}"
                                        alt="Preview Ekstrakurikuler" class="img-fluid rounded"
                                        style="max-height: 180px; width: auto;" id="ekstraImage">
                                </div>
                                <h4 class="mb-3" id="ekstraName">Pilih Ekstrakurikuler</h4>
                                <div class="mb-3">
                                    <h6 class="text-muted mb-1">Jenis</h6>
                                    <p id="ekstraJenis">-</p>
                                </div>
                                <div class="mb-3">
                                    <h6 class="text-muted mb-1">Kuota Tersedia</h6>
                                    <p id="ekstraKuota">-</p>
                                </div>
                                <div class="mb-3">
                                    <h6 class="text-muted mb-1">Pembina</h6>
                                    <p id="ekstraPembina">-</p>
                                </div>
                                <div class="mb-3">
                                    <h6 class="text-muted mb-1">Deskripsi</h6>
                                    <p id="ekstraDeskripsi" class="text-justify">Pilih ekstrakurikuler untuk melihat
                                        deskripsi lengkap</p>
                                </div>
                            </div>
                        </div>

                        <!-- Active Selection Indicator -->
                        <div class="card premium-card mt-4">
                            <div class="card-header bg-primary bg-opacity-10">
                                <h5 class="card-title mb-0">
                                    <i class="mdi mdi-check-circle-outline me-2"></i> Ekstrakurikuler Dipilih
                                </h5>
                            </div>
                            <div class="card-body">
                                @if ($showFirstForm)
                                    <div class="selected-ekstra mb-3">
                                        <span class="badge rounded-pill bg-primary mb-2">Pilihan 1</span>
                                        <h6 id="selectedEkstra1">Belum dipilih</h6>
                                    </div>
                                    <div class="selected-ekstra">
                                        <span class="badge rounded-pill bg-success mb-2">Pilihan 2</span>
                                        <h6 id="selectedEkstra2">Belum dipilih</h6>
                                    </div>
                                @else
                                    <div class="selected-ekstra">
                                        <span class="badge rounded-pill bg-success mb-2">Pilihan Baru</span>
                                        <h6 id="selectedEkstra2">Belum dipilih</h6>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <style>
        /* Premium Styles */
        .text-gradient {
            background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .premium-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .premium-card:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .pending-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .pending-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border-radius: 10px;
            background-color: rgba(255, 193, 7, 0.1);
            border-left: 4px solid #ffc107;
        }

        .pending-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255, 193, 7, 0.2);
            color: #ffc107;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 20px;
        }

        .pending-details {
            flex-grow: 1;
        }

        .select2-container .select2-selection--single {
            height: 45px;
            border-radius: 8px;
            padding: 10px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 43px;
        }

        .form-check-input:checked {
            background-color: #198754;
            border-color: #198754;
        }

        .form-switch .form-check-input {
            width: 3em;
            height: 1.5em;
        }

        @media (max-width: 768px) {
            .sticky-top {
                position: static !important;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Select2
            $('.select2').select2({
                placeholder: "Pilih Ekstrakurikuler",
                allowClear: true
            });

            // Toggle Ekstrakurikuler 2 section
            // Toggle Ekstrakurikuler 2 section
            $('#toggleEkstra2').on('change', function() {
                if (this.checked) {
                    $('#ekstra2Section').slideDown(300);
                    // Focus on the select after animation completes
                    setTimeout(function() {
                        $('#ekstrakurikuler_id_2').select2('focus');
                    }, 300);
                } else {
                    $('#ekstra2Section').slideUp(300);
                    // Clear selection when toggled off
                    $('#ekstrakurikuler_id_2').val('').trigger('change');
                    $('#alasan_2').val('');
                    $('#selectedEkstra2').text('Belum dipilih');
                }
            });

            // Prevent choosing the same ekstrakurikuler in both selections
            function updateDisabledOptions() {
                const ekstra1Val = $('#ekstrakurikuler_id_1').val();
                const ekstra2Val = $('#ekstrakurikuler_id_2').val();

                // Reset all options first
                $('#ekstrakurikuler_id_1 option, #ekstrakurikuler_id_2 option').each(function() {
                    $(this).prop('disabled', $(this).attr('data-disabled') === 'true');
                });

                // Disable selected options in the other dropdown
                if (ekstra1Val) {
                    $(`#ekstrakurikuler_id_2 option[value="${ekstra1Val}"]`).prop('disabled', true);
                }

                if (ekstra2Val) {
                    $(`#ekstrakurikuler_id_1 option[value="${ekstra2Val}"]`).prop('disabled', true);
                }

                // Refresh select2
                $('#ekstrakurikuler_id_1, #ekstrakurikuler_id_2').select2();
            }

            // Update ekstrakurikuler details when selection changes for ekstra 1
            $('#ekstrakurikuler_id_1').on('change', function() {
                updateDisabledOptions();
                updateEkstraDetails($(this));

                // Update selected ekstra display
                const ekstraName = $(this).find('option:selected').text().split('(')[0].trim();
                $('#selectedEkstra1').text(ekstraName || 'Belum dipilih');
            });

            // Update ekstrakurikuler details when selection changes for ekstra 2
            $('#ekstrakurikuler_id_2').on('change', function() {
                updateDisabledOptions();

                // Only update details if this is the active tab
                if ($('#ekstrakurikuler_id_1').is(':focus') === false) {
                    updateEkstraDetails($(this));
                }

                // Update selected ekstra display
                const ekstraName = $(this).find('option:selected').text().split('(')[0].trim();
                $('#selectedEkstra2').text(ekstraName || 'Belum dipilih');
            });

            // Function to update ekstra details in the sidebar
            function updateEkstraDetails(selectElement) {
                const selectedOption = selectElement.find('option:selected');
                const jenis = selectedOption.data('jenis') || '-';
                const kuota = selectedOption.data('kuota') || '-';
                const pembina = selectedOption.data('pembina') || '-';
                const deskripsi = selectedOption.data('deskripsi') || 'Tidak ada deskripsi';
                const ekstraName = selectedOption.text().split('(')[0].trim();

                $('#ekstraName').text(ekstraName || 'Pilih Ekstrakurikuler');
                $('#ekstraJenis').text(jenis ? (jenis.charAt(0).toUpperCase() + jenis.slice(1)) : '-');
                $('#ekstraKuota').text(isNaN(kuota) ? kuota : kuota + ' orang');
                $('#ekstraPembina').text(pembina);
                $('#ekstraDeskripsi').text(deskripsi);

                // Update image (assuming you have images named after ekstra ID)
                if (selectElement.val()) {
                    const imageUrl = `{{ asset('storage/ekstra/') }}/${selectElement.val()}.jpg`;
                    $('#ekstraImage').attr('src', imageUrl).on('error', function() {
                        $(this).attr('src', '{{ asset('assets/images/ekstra/default.jpg') }}');
                    });
                } else {
                    $('#ekstraImage').attr('src', '{{ asset('assets/images/ekstra/default.jpg') }}');
                }
            }

            // Click behavior for showing details when clicking on selected ekstra
            $('#selectedEkstra1, #selectedEkstra2').on('click', function() {
                const isEkstra1 = $(this).attr('id') === 'selectedEkstra1';
                const selectElement = isEkstra1 ? $('#ekstrakurikuler_id_1') : $('#ekstrakurikuler_id_2');

                if (selectElement.val()) {
                    updateEkstraDetails(selectElement);
                    // Scroll to details section on mobile
                    if (window.innerWidth < 992) {
                        $('html, body').animate({
                            scrollTop: $(".sticky-top").offset().top - 20
                        }, 500);
                    }
                }
            });

            // Form validation before submit
            // Form validation before submit
            $('#pendaftaranForm').on('submit', function(e) {
                // Check if first form is shown (when no pending registrations)
                const showFirstForm = $('#ekstrakurikuler_id_1').length > 0;

                const ekstra1 = $('#ekstrakurikuler_id_1').val();
                const ekstra2 = $('#ekstrakurikuler_id_2').val();

                // Minimal harus memilih salah satu ekstra
                if (!ekstra1 && !ekstra2) {
                    e.preventDefault();
                    alert('Anda harus memilih minimal satu ekstrakurikuler!');
                    return false;
                }

                // Jika memilih keduanya, pastikan tidak sama
                if (ekstra1 && ekstra2 && ekstra1 === ekstra2) {
                    e.preventDefault();
                    alert('Anda tidak dapat memilih ekstrakurikuler yang sama untuk kedua pilihan!');
                    return false;
                }

                return true;
            });

            // Trigger change event if there's already a selected value
            if ($('#ekstrakurikuler_id_1').length > 0 && $('#ekstrakurikuler_id_1').val()) {
                $('#ekstrakurikuler_id_1').trigger('change');
            }

            if ($('#ekstrakurikuler_id_2').val()) {
                $('#ekstrakurikuler_id_2').trigger('change');
            }

            // Store initial disabled state
            $('#ekstrakurikuler_id_1 option, #ekstrakurikuler_id_2 option').each(function() {
                $(this).attr('data-disabled', $(this).prop('disabled'));
            });

            // Initial update of disabled options
            updateDisabledOptions();
        });
    </script>

@endsection
