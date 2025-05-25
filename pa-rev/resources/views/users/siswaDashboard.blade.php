@extends('layout.MainLayout')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Header -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="dashboard-header">
                    <div class="header-content">
                        <h1 class="text-gradient display-5">Ekstrakurikuler Saya</h1>
                        <p class="lead text-muted">Selamat datang di portal eksklusif kegiatan ekstrakurikuler</p>
                    </div>
                    <div class="user-profile">
                        <div class="avatar-group">
                            <div class="ms-3">
                                <h4 class="mb-0">{{ Auth::user()->name }}</h4>
                                <p class="text-muted mb-1">{{ Auth::user()->kelas ?? 'Siswa' }}</p>
                                <span class="badge bg-primary bg-opacity-10 text-primary">Anggota Aktif</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-5 g-4">
            <div class="col-md-4">
                <div class="card stat-card stat-card-primary">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon">
                                <i class="mdi mdi-calendar-check"></i>
                            </div>
                            <div class="ms-3 flex-grow-1">
                                <h6 class="stat-title">Kehadiran</h6>
                                <div class="d-flex align-items-center">
                                    <h2 class="stat-value mb-0">{{ $jumlahHadir ?? 0 }}</h2>
                                    <span class="badge bg-success ms-2">{{ $persenHadir ?? '0%' }}</span>
                                </div>
                                <div class="progress mt-2">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $persenHadir ?? '0%' }}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card stat-card-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon">
                                <i class="mdi mdi-trophy-variant"></i>
                            </div>
                            <div class="ms-3 flex-grow-1">
                                <h6 class="stat-title">Prestasi</h6>
                                <div class="d-flex align-items-center">
                                    <h2 class="stat-value mb-0">{{ $jumlahPrestasi ?? 0 }}</h2>
                                    <span class="badge bg-warning ms-2">{{ $jumlahPrestasiBaru ?? '0 Baru' }}</span>
                                </div>
                                <div class="achievement-preview mt-2">
                                    <img src="{{ asset('assets/images/medal-gold.png') }}" width="24" alt="">
                                    <img src="{{ asset('assets/images/medal-silver.png') }}" width="24" alt="">
                                    <img src="{{ asset('assets/images/medal-bronze.png') }}" width="24" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card stat-card-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon">
                                <i class="mdi mdi-notebook-edit"></i>
                            </div>
                            <div class="ms-3 flex-grow-1">
                                <h6 class="stat-title">Logbook</h6>
                                <div class="d-flex align-items-center">
                                    <h2 class="stat-value mb-0">{{ $jumlahLogbook ?? 0 }}</h2>
                                    <span class="badge bg-info ms-2">{{ $jumlahLogbookBaru ?? '0 Terbaru' }}</span>
                                </div>
                                <div class="progress mt-2">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $persenLogbook ?? '0%' }}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row g-4">
            <!-- Jadwal & Presensi -->
            <div class="col-lg-8">
                <div class="card premium-card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title mb-0"><i class="mdi mdi-calendar-text me-2"></i> Jadwal Ekstrakurikuler</h3>
                        <div class="dropdown">
                            <button class="btn btn-soft-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="mdi mdi-filter"></i> Filter
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item active" href="#">Semua</a></li>
                                <li><a class="dropdown-item" href="#">Basket</a></li>
                                <li><a class="dropdown-item" href="#">Robotik</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="schedule-container">
                            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $day)
                            <div class="schedule-day">
                                <div class="day-header">
                                    <h5>{{ $day }}</h5>
                                    <span class="badge bg-primary bg-opacity-10 text-primary">Hari Ini</span>
                                </div>
                                <div class="schedule-items">
                                    <div class="schedule-item active">
                                        <div class="item-icon">
                                            <img src="{{ asset('assets/images/ekstra/basket.jpg') }}" alt="">
                                        </div>
                                        <div class="item-details">
                                            <h6>Basket</h6>
                                            <p class="text-muted mb-1">15:00 - 17:00 WIB</p>
                                            <p class="text-muted mb-0">Lapangan Basket Utama</p>
                                        </div>
                                        <div class="item-status">
                                            <span class="badge bg-success">Aktif</span>
                                            <button class="btn btn-soft-primary btn-sm">Detail</button>
                                        </div>
                                    </div>
                                    <div class="schedule-item">
                                        <div class="item-icon">
                                            <img src="{{ asset('assets/images/ekstra/robotik.jpg') }}" alt="">
                                        </div>
                                        <div class="item-details">
                                            <h6>Robotik</h6>
                                            <p class="text-muted mb-1">13:00 - 15:00 WIB</p>
                                            <p class="text-muted mb-0">Lab Komputer 3</p>
                                        </div>
                                        <div class="item-status">
                                            <span class="badge bg-secondary">Besok</span>
                                            <button class="btn btn-soft-primary btn-sm">Detail</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Riwayat Presensi -->
                <div class="card premium-card mt-4">
                    <div class="card-header">
                        <h3 class="card-title mb-0"><i class="mdi mdi-account-check me-2"></i> Riwayat Presensi</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table attendance-table">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Ekstrakurikuler</th>
                                        <th>Status</th>
                                        <th>Waktu</th>
                                        <th>Pembimbing</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($riwayatPresensi ?? [] as $riwayat)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($riwayat->tanggal)->translatedFormat('d F Y') }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('assets/images/ekstra/' . strtolower($riwayat->ekstrakurikuler->nama) . '.jpg') }}" class="rounded-circle avatar-xs me-2" alt="">
                                                <span>{{ $riwayat->ekstrakurikuler->nama }}</span>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-{{ $riwayat->status == 'Hadir' ? 'success' : 'warning' }}">{{ $riwayat->status }}</span></td>
                                        <td>{{ $riwayat->jam ?? '-' }}</td>
                                        <td>{{ $riwayat->pembimbing->name ?? '-' }}</td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="5" class="text-center text-muted">Belum ada data presensi.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Ekstrakurikuler Saya -->
                <div class="card premium-card">
                    <div class="card-header">
                        <h3 class="card-title mb-0"><i class="mdi mdi-account-group me-2"></i> Ekstrakurikuler Saya</h3>
                    </div>
                    <div class="card-body">
                        <div class="extracurricular-list">
                            @forelse($ekstrakurikulerSaya ?? [] as $ekstra)
                            <div class="extracurricular-item active">
                                <div class="item-icon">
                                    <img src="{{ asset('assets/images/ekstra/' . strtolower($ekstra->nama) . '.jpg') }}" alt="">
                                </div>
                                <div class="item-details">
                                    <h5>{{ $ekstra->nama }}</h5>
                                    <p class="text-muted">Pelatih: {{ $ekstra->pembimbing->name ?? '-' }}</p>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: {{ $ekstra->kehadiran_persen ?? '0%' }}"></div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <small>{{ $ekstra->jumlah_hadir ?? 0 }} Kehadiran</small>
                                        <small>{{ $ekstra->kehadiran_persen ?? '0%' }}</small>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <p class="text-muted">Belum tergabung dalam ekstrakurikuler.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Aktivitas Terbaru -->
                <div class="card premium-card mt-4">
                    <div class="card-header">
                        <h3 class="card-title mb-0"><i class="mdi mdi-bell-ring-outline me-2"></i> Aktivitas Terbaru</h3>
                    </div>
                    <div class="card-body">
                        <div class="activity-timeline">
                            <div class="activity-item">
                                <div class="activity-icon"><i class="mdi mdi-calendar-check"></i></div>
                                <div class="activity-content">
                                    <h6>Presensi Tercatat</h6>
                                    <p class="text-muted">Anda hadir dalam sesi Basket hari ini</p>
                                    <small class="text-muted">Hari ini, 15:02 WIB</small>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon"><i class="mdi mdi-trophy-variant"></i></div>
                                <div class="activity-content">
                                    <h6>Prestasi Baru</h6>
                                    <p class="text-muted">Juara 1 Lomba Robotik Regional</p>
                                    <small class="text-muted">3 hari yang lalu</small>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon"><i class="mdi mdi-notebook-edit"></i></div>
                                <div class="activity-content">
                                    <h6>Logbook Diperbarui</h6>
                                    <p class="text-muted">Pembuatan robot line follower</p>
                                    <small class="text-muted">5 hari yang lalu</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Akses Cepat -->
                <div class="card premium-card mt-4">
                    <div class="card-header">
                        <h3 class="card-title mb-0"><i class="mdi mdi-link-variant me-2"></i> Akses Cepat</h3>
                    </div>
                    <div class="card-body">
                        <div class="quick-links">
                            <a href="#" class="quick-link">
                                <div class="link-icon bg-primary bg-opacity-10 text-primary"><i class="mdi mdi-trophy-award"></i></div>
                                <span>Prestasi Saya</span>
                            </a>
                            <a href="#" class="quick-link">
                                <div class="link-icon bg-success bg-opacity-10 text-success"><i class="mdi mdi-notebook-multiple"></i></div>
                                <span>Logbook</span>
                            </a>
                            <a href="#" class="quick-link">
                                <div class="link-icon bg-info bg-opacity-10 text-info"><i class="mdi mdi-calendar-account"></i></div>
                                <span>Kalender</span>
                            </a>
                            <a href="#" class="quick-link">
                                <div class="link-icon bg-warning bg-opacity-10 text-warning"><i class="mdi mdi-chart-bar"></i></div>
                                <span>Statistik</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- .container-fluid -->
</div>
<style>
    /* Premium Dashboard Styles */
    .dashboard-header {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    @media (min-width: 768px) {
        .dashboard-header {
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }
    }

    .text-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .avatar-xl {
        width: 80px;
        height: 80px;
    }

    /* Stat Cards */
    .stat-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .stat-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0.05;
        z-index: -1;
    }

    .stat-card-primary::after {
        background-color: #3a7bd5;
    }

    .stat-card-success::after {
        background-color: #00b09b;
    }

    .stat-card-info::after {
        background-color: #00d2ff;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .stat-card-primary .stat-icon {
        background-color: rgba(58, 123, 213, 0.1);
        color: #3a7bd5;
    }

    .stat-card-success .stat-icon {
        background-color: rgba(0, 176, 155, 0.1);
        color: #00b09b;
    }

    .stat-card-info .stat-icon {
        background-color: rgba(0, 210, 255, 0.1);
        color: #00d2ff;
    }

    .stat-title {
        font-size: 14px;
        color: #6c757d;
        margin-bottom: 5px;
    }

    .stat-value {
        font-size: 28px;
        font-weight: 700;
    }

    .achievement-preview img {
        margin-right: 5px;
        transition: all 0.3s ease;
    }

    .achievement-preview img:hover {
        transform: scale(1.2);
    }

    /* Premium Card */
    .premium-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.03);
        overflow: hidden;
    }

    .premium-card .card-header {
        background-color: transparent;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        padding: 20px;
    }

    .premium-card .card-body {
        padding: 20px;
    }

    /* Schedule Section */
    .schedule-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .schedule-day {
        background: white;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
    }

    .day-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px dashed #eee;
    }

    .schedule-items {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .schedule-item {
        display: flex;
        align-items: center;
        padding: 12px;
        border-radius: 8px;
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }

    .schedule-item:hover {
        border-color: rgba(58, 123, 213, 0.2);
        background-color: rgba(58, 123, 213, 0.03);
    }

    .schedule-item.active {
        background-color: rgba(58, 123, 213, 0.05);
        border-color: rgba(58, 123, 213, 0.1);
    }

    .item-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        overflow: hidden;
        margin-right: 15px;
    }

    .item-icon img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .item-details {
        flex-grow: 1;
    }

    .item-details h6 {
        margin-bottom: 5px;
        font-size: 15px;
    }

    .item-status {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 5px;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .schedule-item {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .item-status {
            width: 100%;
            flex-direction: row;
            justify-content: space-between;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px dashed #eee;
        }
        
        .extracurricular-item {
            flex-direction: column;
        }
        
        .quick-links {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /* Extracurricular List */
    .extracurricular-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .extracurricular-item {
        display: flex;
        align-items: center;
        padding: 15px;
        border-radius: 10px;
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
    }

    .extracurricular-item.active {
        border-color: rgba(58, 123, 213, 0.3);
        background-color: rgba(58, 123, 213, 0.05);
    }

    .extracurricular-item .item-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
    }

    /* Activity Timeline */
    .activity-timeline {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .activity-item {
        display: flex;
        gap: 15px;
        position: relative;
        padding-bottom: 20px;
    }

    .activity-item:not(:last-child)::after {
        content: '';
        position: absolute;
        left: 20px;
        top: 35px;
        bottom: 0;
        width: 1px;
        background-color: rgba(0,0,0,0.1);
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: rgba(58, 123, 213, 0.1);
        color: #3a7bd5;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .activity-content {
        flex-grow: 1;
    }

    .activity-content h6 {
        margin-bottom: 5px;
        font-size: 15px;
    }

    /* Quick Links */
    .quick-links {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    .quick-link {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 15px 10px;
        border-radius: 10px;
        text-align: center;
        transition: all 0.3s ease;
        color: inherit;
        text-decoration: none;
        border: 1px solid rgba(0,0,0,0.05);
    }

    .quick-link:hover {
        background-color: rgba(58, 123, 213, 0.05);
        border-color: rgba(58, 123, 213, 0.1);
        transform: translateY(-3px);
    }

    .quick-link .link-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-bottom: 10px;
    }

    /* Attendance Table */
    .attendance-table {
        --bs-table-striped-bg: rgba(58, 123, 213, 0.03);
    }

    .attendance-table td, 
    .attendance-table th {
        vertical-align: middle;
    }
</style>
@endsection