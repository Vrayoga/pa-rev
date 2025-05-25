@extends('layoutUser.MainLayout')

@section('content')
    <!-- Main Content Container -->
    <div class="main-content-container">
        <!-- Ekskul Profile Section -->
        <div class="ekskul-profile">
            <!-- Header Section -->
            <div class="ekskul-header">
                <div class="ekskul-cover"
                    style="background-image: url('{{ asset('storage/' . $ekstrakurikuler->Gambar) }}')"></div>
                <div class="ekskul-title">
                    <h2>Ekstrakurikuler {{ $ekstrakurikuler->nama_ekstrakurikuler }}</h2>
                    <span class="badge-kategori">Kegiatan {{ $ekstrakurikuler->jenis }}</span>
                </div>
            </div>

            <!-- Content Section -->
            <div class="ekskul-content">
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Deskripsi Kegiatan -->
                        <div class="info-section">
                            <h4><i class="bi bi-info-circle"></i> Deskripsi Kegiatan</h4>
                            <div class="description-box">
                                <p>{{ $ekstrakurikuler->Deskripsi }}</p>
                            </div>
                        </div>

                        <!-- Prestasi -->
                        <div class="info-section">
                            <h4><i class="bi bi-trophy"></i> Prestasi</h4>
                            <div class="prestasi-container">
                                <div class="prestasi-list">
                                    <div class="prestasi-item" data-bs-toggle="modal" data-bs-target="#prestasiModal">
                                        <div class="prestasi-year">2023</div>
                                        <div class="prestasi-detail">
                                            <h5>Juara 1 Lomba Tingkat III Kwarcab Sumenep</h5>
                                            <p>Lomba Pionering dan Sandi Morse</p>
                                        </div>
                                    </div>
                                    <div class="prestasi-item" data-bs-toggle="modal" data-bs-target="#prestasiModal">
                                        <div class="prestasi-year">2023</div>
                                        <div class="prestasi-detail">
                                            <h5>Juara 2 Jambore Regional Jawa Timur</h5>
                                            <p>Kategori Keterampilan Pioneering</p>
                                        </div>
                                    </div>
                                    <div class="prestasi-item" data-bs-toggle="modal" data-bs-target="#prestasiModal">
                                        <div class="prestasi-year">2022</div>
                                        <div class="prestasi-detail">
                                            <h5>Juara Harapan 1 Jambore Daerah Jawa Timur</h5>
                                            <p>Kategori Penggalang Tegak</p>
                                        </div>
                                    </div>
                                    <div class="prestasi-item" data-bs-toggle="modal" data-bs-target="#prestasiModal">
                                        <div class="prestasi-year">2022</div>
                                        <div class="prestasi-detail">
                                            <h5>Peserta Terbaik Perkemahan Bakti</h5>
                                            <p>Kegiatan Tingkat Kabupaten</p>
                                        </div>
                                    </div>
                                    <div class="prestasi-item" data-bs-toggle="modal" data-bs-target="#prestasiModal">
                                        <div class="prestasi-year">2021</div>
                                        <div class="prestasi-detail">
                                            <h5>Peserta Terbaik Perkemahan Wirakarya</h5>
                                            <p>Kegiatan Kepramukaan Tingkat Nasional</p>
                                        </div>
                                    </div>
                                    <div class="prestasi-item" data-bs-toggle="modal" data-bs-target="#prestasiModal">
                                        <div class="prestasi-year">2021</div>
                                        <div class="prestasi-detail">
                                            <h5>Juara 3 Lomba Cerdas Cermat Pramuka</h5>
                                            <p>Tingkat Kecamatan</p>
                                        </div>
                                    </div>
                                    <div class="prestasi-item" data-bs-toggle="modal" data-bs-target="#prestasiModal">
                                        <div class="prestasi-year">2020</div>
                                        <div class="prestasi-detail">
                                            <h5>Juara 1 Lomba Keterampilan Baris Berbaris</h5>
                                            <p>HUT Pramuka Ke-59</p>
                                        </div>
                                    </div>
                                    <div class="prestasi-item" data-bs-toggle="modal"
                                        data-bs-target="#prestasiModal">
                                        <div class="prestasi-year">2020</div>
                                        <div class="prestasi-detail">
                                            <h5>Peserta Teraktif Kegiatan Virtual Pramuka</h5>
                                            <p>Masa Pandemi COVID-19</p>
                                        </div>
                                    </div>
                                    <div class="prestasi-item" data-bs-toggle="modal"
                                        data-bs-target="#prestasiModal">
                                        <div class="prestasi-year">2019</div>
                                        <div class="prestasi-detail">
                                            <h5>Juara Umum Perkemahan Sabtu Minggu</h5>
                                            <p>Kegiatan Gabungan Sekolah Se-Kabupaten</p>
                                        </div>
                                    </div>
                                    <div class="prestasi-item" data-bs-toggle="modal"
                                        data-bs-target="#prestasiModal">
                                        <div class="prestasi-year">2019</div>
                                        <div class="prestasi-detail">
                                            <h5>Juara 2 Lomba Kreasi Seni Pramuka</h5>
                                            <p>Festival Pramuka Kabupaten</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Back Button -->
                        <a href="/" class="btn btn-back">
                            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Ekskul
                        </a>
                    </div>

                    <!-- Sidebar Info -->

                    <div class="col-lg-4">
                        <div class="sidebar-info">
                            <!-- Jadwal Kegiatan Box -->
                            <div class="info-box schedule-box">
                                <div class="info-box-header">
                                    <i class="bi bi-calendar-week"></i>
                                    <h4>Jadwal Kegiatan & detail</h4>
                                    <span class="badge-schedule">{{ $ekstrakurikuler->Periode }}</span>
                                </div>

                                <div class="schedule-timeline">
                                    <div class="schedule-timeline">
                                        @foreach ($ekstrakurikuler->jadwals as $jadwal)
                                            <div class="schedule-item">
                                                <div class="schedule-icon">
                                                    <i class="bi bi-clock"></i>
                                                </div>
                                                <div class="schedule-detail">
                                                    <div class="schedule-day">{{ $jadwal->hari }}</div>
                                                    <div class="schedule-time">{{ $jadwal->jam_mulai }} -
                                                        {{ $jadwal->jam_selesai }}</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="schedule-item">
                                        <div class="schedule-icon">
                                            <i class="bi bi-geo-alt"></i>
                                        </div>
                                        <div class="schedule-detail">
                                            <div class="schedule-location">Tempat kegiatan</div>
                                            <div class="schedule-room">{{ $ekstrakurikuler->Lokasi }}</div>
                                        </div>
                                    </div>
                                    <div class="schedule-item">
                                        <div class="schedule-icon">
                                            <i class="bi bi-credit-card"></i>
                                        </div>
                                        <div class="schedule-detail">
                                            <div class="schedule-location">Kategori</div>
                                            <div class="schedule-kategori">
                                                {{ $ekstrakurikuler->kategori->nama_kategori ?? 'Tidak ada kategori' }}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Pembina Box -->
                            <div class="info-box mentor-box">
                                <div class="info-box-header">
                                    <i class="bi bi-person-badge"></i>
                                    <h4>guru pembimbing</h4>
                                </div>

                                <div class="mentor-list">
                                    <div class="mentor-item">
                                        <div class="mentor-avatar">
                                            <img src="{{ asset('assets/images/users/user-dummy-img.jpg') }}"
                                                alt="Pembina">
                                        </div>
                                        <div class="mentor-info">
                                            @if ($ekstrakurikuler->user)
                                                <h5 class="mentor-name">{{ $ekstrakurikuler->user->name }}</h5>
                                                <p class="mentor-role">Guru pembimbing</p>
                                            @else
                                                <p class="text-muted">Belum ada pembimbing</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Statistik Box -->
                            <div class="info-box stats-box">
                                <div class="info-box-header">
                                    <i class="bi bi-graph-up"></i>
                                    <h4>Statistik</h4>
                                </div>

                                <div class="stats-grid">
                                    <div class="stat-item">
                                        <div class="stat-value">{{ $ekstrakurikuler->jumlah_anggota ?? 0 }}</div>
                                        <div class="stat-label">Anggota Diterima</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-value">12</div>
                                        <div class="stat-label">Prestasi</div>
                                    </div>
                                </div>

                                @if ($ekstrakurikuler->jenis === 'wajib')
                                    <div class="alert alert-info mt-2">
                                        <i class="bi bi-info-circle"></i> Ekstrakurikuler wajib — kuota tidak dibatasi.
                                    </div>
                                @else
                                    <div class="progress-container">
                                        <div class="progress-info">
                                            <span>Kuota Tersedia</span>
                                            <span>{{ $ekstrakurikuler->sisa_kuota }}/{{ $ekstrakurikuler->kuota }}</span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar"
                                                style="width: {{ $ekstrakurikuler->persentase_kuota }}%;
                       background-color: {{ $ekstrakurikuler->persentase_kuota >= 100 ? '#dc3545' : '#28a745' }};">
                                            </div>
                                        </div>
                                        <div class="progress-text text-center mt-2 small">
                                            @if ($ekstrakurikuler->persentase_kuota >= 100)
                                                <span class="text-danger"><i class="bi bi-exclamation-circle"></i>
                                                    Kuota Penuh!</span>
                                            @else
                                                <span class="text-success">{{ $ekstrakurikuler->sisa_kuota }} tempat
                                                    tersisa</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Prestasi Modal -->
    <div class="modal fade" id="prestasiModal" tabindex="-1" aria-labelledby="prestasiModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="prestasiModalLabel">Detail Prestasi</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-group mb-4">
                                <h5><i class="bi bi-trophy-fill"></i> Nama Kegiatan</h5>
                                <p>Juara 1 Lomba Tingkat III Kwarcab Sumenep</p>
                            </div>

                            <div class="info-group mb-4">
                                <h5><i class="bi bi-award-fill"></i> Peringkat</h5>
                                <p>Juara 1</p>
                            </div>

                            <div class="info-group mb-4">
                                <h5><i class="bi bi-calendar-date-fill"></i> Tanggal Kejuaraan</h5>
                                <p>15 Agustus 2023</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-group mb-4">
                                <h5><i class="bi bi-globe"></i> Tingkat Kejuaraan</h5>
                                <p>Kabupaten</p>
                            </div>

                            <div class="info-group mb-4">
                                <h5><i class="bi bi-card-text"></i> Deskripsi</h5>
                                <p>Lomba pionering dan sandi morse yang diikuti oleh 30 sekolah se-Kabupaten Sumenep.
                                    Tim kami berhasil menyelesaikan semua tantangan dengan sempurna dalam waktu
                                    tercepat.</p>
                            </div>

                            <div class="info-group">
                                <h5><i class="bi bi-image-fill"></i> Dokumentasi</h5>
                                <div class="prestasi-image">
                                    <img src="https://via.placeholder.com/800x500" alt="Foto Prestasi"
                                        class="img-fluid rounded">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

@endsection
