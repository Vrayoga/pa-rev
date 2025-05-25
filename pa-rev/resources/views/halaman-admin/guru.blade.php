@extends('layout.MainLayout')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">DASHBOARD PRESENSI GURU</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Presensi</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card overflow-hidden">
                        <div class="bg-primary-subtle">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-3">
                                        <h5 class="text-primary">Presensi Ekstrakurikuler</h5>
                                        <p>Hari ini: {{ ucfirst($hariIni) }}</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="{{ asset('assets/images/profile-img.png') }}" alt=""
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="pt-4">
                                        @if ($ekstraGuru->isEmpty())
                                            <div class="alert alert-danger">
                                                <strong>Data tidak ditemukan!</strong>
                                                <p>Pastikan:</p>
                                                <ul>
                                                    <li>Guru memiliki ekstrakurikuler yang dibimbing</li>
                                                    <li>Ada jadwal untuk hari ini</li>
                                                </ul>
                                            </div>
                                        @else
                                            <div class="mb-3">
                                                <label class="form-label">Pilih Ekstrakurikuler</label>
                                                <select class="form-select" id="selectEkstra">
                                                    <option value="">-- Pilih --</option>
                                                    @foreach ($ekstraGuru as $ekstra)
                                                        @if ($ekstra->jadwals->where('hari', strtolower($hariIni))->isNotEmpty())
                                                            @php
                                                                $jadwalHariIni = $ekstra->jadwals
                                                                    ->where('hari', strtolower($hariIni))
                                                                    ->first();
                                                                $sesiAktif = $jadwalHariIni
                                                                    ? $jadwalHariIni
                                                                        ->sesiAbsenEkstrakurikuler()
                                                                        ->where('is_active', true)
                                                                        ->exists()
                                                                    : false;
                                                                $sesiHariIni = $jadwalHariIni
                                                                    ? $jadwalHariIni
                                                                        ->sesiAbsenEkstrakurikuler()
                                                                        ->whereDate('waktu_buka', now()->toDateString())
                                                                        ->exists()
                                                                    : false;
                                                            @endphp
                                                            <option value="{{ $ekstra->id }}"
                                                                data-jam-mulai="{{ $jadwalHariIni->jam_mulai ?? '' }}"
                                                                data-jam-selesai="{{ $jadwalHariIni->jam_selesai ?? '' }}"
                                                                data-sesi-aktif="{{ $sesiAktif ? '1' : '0' }}"
                                                                data-jadwal-id="{{ $jadwalHariIni->id ?? '' }}"
                                                                data-sudah-sesi-hari-ini="{{ $sesiHariIni ? '1' : '0' }}"
                                                                @if (session('selected_ekstra') == $ekstra->id) selected @endif>
                                                                {{ $ekstra->nama_ekstrakurikuler }} ({{ $ekstra->jenis }})
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <h5 class="font-size-15" id="displayJamMulai">-</h5>
                                                    <p class="text-muted mb-0">Jam Mulai</p>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="font-size-15" id="displayJamSelesai">-</h5>
                                                    <p class="text-muted mb-0">Jam Selesai</p>
                                                </div>
                                            </div>

                                            <div class="mt-4" id="actionButtons">
                                                <p class="text-muted">Pilih ekstrakurikuler terlebih dahulu</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="pt-4">
                                        <h4 class="card-title mb-4">Jadwal Ekstrakurikuler</h4>
                                        <div class="table-responsive">
                                            @if ($ekstraGuru->isEmpty())
                                                <div class="alert alert-info">
                                                    <i class="mdi mdi-information-outline"></i> Saat ini belum ada jadwal
                                                    ekstrakurikuler untuk hari ini.
                                                </div>
                                            @else
                                                <table class="table table-centered table-nowrap mb-0">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Ekstrakurikuler</th>
                                                            <th>Hari</th>
                                                            <th>Jadwal</th>
                                                            <th>waktu Buka</th>
                                                            <th>Waktu tutup</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($ekstraGuru as $index => $ekstra)
                                                            @foreach ($ekstra->jadwals as $jadwal)
                                                                <tr>
                                                                    <td>{{ $index + 1 }}</td>
                                                                    <td>{{ $ekstra->nama_ekstrakurikuler }}</td>
                                                                    <td>{{ ucfirst($jadwal->hari) }}</td>
                                                                    <td>{{ date('H:i', strtotime($jadwal->jam_mulai)) }} -
                                                                        {{ date('H:i', strtotime($jadwal->jam_selesai)) }}
                                                                    </td>
                                                                    @php
                                                                        $sesi = $jadwal->sesiAbsenEkstrakurikuler->first();
                                                                    @endphp
                                                                    <td>
                                                                        {{ $sesi ? \Carbon\Carbon::parse($sesi->waktu_buka)->format('H:i') : '-' }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $sesi && $sesi->waktu_tutup ? \Carbon\Carbon::parse($sesi->waktu_tutup)->format('H:i') : '-' }}
                                                                    </td>
                                                                    <td>
                                                                        @if ($sesi)
                                                                            @if ($sesi->is_active)
                                                                                <span class="badge bg-success">Aktif</span>
                                                                            @else
                                                                                <span class="badge bg-info">Sudah
                                                                                    Presensi</span>
                                                                            @endif
                                                                        @else
                                                                            <span class="badge bg-warning">Belum
                                                                                Dibuka</span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (!$ekstraGuru->isEmpty())
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const selectEkstra = document.getElementById('selectEkstra');
                    const actionDiv = document.getElementById('actionButtons');

                    function updateView(selectedOption) {
                        const jamMulai = selectedOption.dataset.jamMulai || '-';
                        const jamSelesai = selectedOption.dataset.jamSelesai || '-';
                        const isSesiAktif = selectedOption.dataset.sesiAktif === '1';
                        const sudahSesiHariIni = selectedOption.dataset.sudahSesiHariIni === '1';
                        const jadwalId = selectedOption.dataset.jadwalId || '';

                        document.getElementById('displayJamMulai').textContent = jamMulai;
                        document.getElementById('displayJamSelesai').textContent = jamSelesai;

                        if (!selectedOption.value) {
                            actionDiv.innerHTML = '<p class="text-muted">Pilih ekstrakurikuler terlebih dahulu</p>';
                            return;
                        }

                        if (isSesiAktif) {
                            actionDiv.innerHTML = `
                            <div class="d-flex gap-2">
                                <a href="/absensi/siswa?jadwal_id=${jadwalId}" class="btn btn-success btn-sm">
                                    <i class="mdi mdi-account-check"></i> Absen Siswa
                                </a>
                                <form action="{{ route('absensi.tutup') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="jadwal_id" value="${jadwalId}">
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="mdi mdi-lock"></i> Tutup Absen
                                    </button>
                                </form>
                            </div>
                        `;
                        } else {
                            actionDiv.innerHTML = `
                            <form action="/absensi/buka" method="POST">
                                @csrf
                                <input type="hidden" name="jadwal_id" value="${jadwalId}">
                                <button type="submit" class="btn btn-primary btn-sm" ${sudahSesiHariIni ? 'disabled' : ''}>
                                    Buka Absen <i class="mdi mdi-arrow-right ms-1"></i>
                                </button>
                            </form>
                            ${sudahSesiHariIni ? '<small class="text-muted d-block mt-1">Sesi hari ini sudah pernah dibuka.</small>' : ''}
                        `;
                        }
                    }

                    // Set selected option from session
                    @if (session('selected_ekstra'))
                        const selectedOption = selectEkstra.querySelector(
                            'option[value="{{ session('selected_ekstra') }}"]');
                        if (selectedOption) {
                            selectEkstra.value = selectedOption.value;
                            updateView(selectedOption);
                        }
                    @endif

                    selectEkstra.addEventListener('change', function() {
                        updateView(this.options[this.selectedIndex]);
                    });
                });
            </script>
        @endif

        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Toastify({
                        text: "{{ session('success') }}",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#4CAF50",
                    }).showToast();
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Toastify({
                        text: "{{ session('error') }}",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#F44336",
                    }).showToast();
                });
            </script>
        @endif
    @endsection
