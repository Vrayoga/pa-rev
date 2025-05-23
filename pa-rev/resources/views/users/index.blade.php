@extends('layoutUser.MainLayout')


@section('content')
    <!-- Scroll Indicator -->
    <div class="scroll-indicator">
        <i class="bi bi-chevron-down"></i>
        <span>SCROLL</span>
    </div>

    <!-- Hero Section with Ekstrakurikuler (Beranda) -->
    <section id="beranda" class="hero-section">
        <div class="container hero-content">
            <div class="row">
                <div class="col-lg-7 mb-5" data-aos="fade-right" data-aos-duration="1000">
                    <h3 class="section-title">Ekstrakurikuler SMK 1 SUMENEP</h3>
                    <p class="section-subtitle">Temukan dan kembangkan bakat Anda melalui kegiatan ekstrakurikuler
                        premium di SMKN 1 Sumenep. Program eksklusif kami dirancang untuk membentuk karakter dan
                        keahlian siswa.</p>
                    <a href="#statistik" class="btn btn-outline-gold mt-3">Jelajahi Lebih Lanjut</a>
                </div>
            </div>

            <div class="ekskul-carousel" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                <div class="carousel-container">
                    @foreach ($ekstrakurikulers as $ekskul)
                        <div class="ekskul-card">
                            <img src="{{ asset('storage/' . $ekskul->gambar) }}" class="ekskul-img"
                                alt="{{ $ekskul->nama_ekstrakurikuler }}">
                            <div class="card-content">
                                <h3 class="card-title">{{ $ekskul->nama_ekstrakurikuler }}</h3>
                                <div class="card-schedule">
                                    <i class="bi bi-clock-fill"></i>
                                    @if ($ekskul->jadwals->isNotEmpty())
                                        @foreach ($ekskul->jadwals as $jadwal)
                                            {{ $jadwal->hari }} ({{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }})
                                            @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    @else
                                        <span class="text-muted">Belum ada jadwal</span>
                                    @endif
                                </div>
                                <p class="card-description">
                                    {{ \Illuminate\Support\Str::limit($ekskul->deskripsi, 120, '...') }}</p>
                                <a href="{{ route('ekstrakurikuler.show', $ekskul->id) }}"
                                    class="card-button text-decoration-none">Selengkapnya</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="carousel-controls">
                    <div class="carousel-control prev-btn">
                        <i class="bi bi-chevron-left"></i>
                    </div>
                    <div class="carousel-control next-btn">
                        <i class="bi bi-chevron-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section id="statistik" class="statistics-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="1000">
                <h2 class="section-title mx-auto" style="color: var(--navy);">Prestasi Kami</h2>
                <p class="text-muted">Kualitas dan keunggulan dalam setiap kegiatan ekstrakurikuler</p>
            </div>

            <div class="row">
                <div class="col-md-3 col-sm-6 mb-4" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="0">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-collection"></i>
                        </div>
                        <h3 class="stat-number">24</h3>
                        <p class="stat-title">Program Unggulan</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 mb-4" data-aos="zoom-in" data-aos-duration="1000"
                    data-aos-delay="200">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h3 class="stat-number">850</h3>
                        <p class="stat-title">Siswa Aktif</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 mb-4" data-aos="zoom-in" data-aos-duration="1000"
                    data-aos-delay="400">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-calendar-check-fill"></i>
                        </div>
                        <h3 class="stat-number">18</h3>
                        <p class="stat-title">Kegiatan Rutin</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 mb-4" data-aos="zoom-in" data-aos-duration="1000"
                    data-aos-delay="600">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="bi bi-trophy-fill"></i>
                        </div>
                        <h3 class="stat-number">75</h3>
                        <p class="stat-title">Penghargaan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="features-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="1000">
                <h2 class="section-title mx-auto" style="color: var(--navy);">Fitur Eksklusif</h2>
                <p class="text-muted">Pengalaman premium dalam pengembangan bakat siswa</p>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="0">
                    <div class="feature-card">
                        <i class="bi bi-calendar-plus feature-icon"></i>
                        <h3 class="feature-title">Pendaftaran Premium</h3>
                        <p class="feature-desc">Sistem pendaftaran eksklusif dengan prioritas akses dan konfirmasi
                            instan untuk pengalaman yang lebih personal.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="1000"
                    data-aos-delay="200">
                    <div class="feature-card">
                        <i class="bi bi-journal-text feature-icon"></i>
                        <h3 class="feature-title">Manajemen Jadwal</h3>
                        <p class="feature-desc">Sistem penjadwalan canggih dengan notifikasi real-time dan integrasi
                            kalender personal.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="1000"
                    data-aos-delay="400">
                    <div class="feature-card">
                        <i class="bi bi-person-badge feature-icon"></i>
                        <h3 class="feature-title">Pembina Profesional</h3>
                        <p class="feature-desc">Dibimbing oleh mentor berpengalaman dengan rekam jejak prestasi di
                            bidangnya masing-masing.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="1000"
                    data-aos-delay="200">
                    <div class="feature-card">
                        <i class="bi bi-award feature-icon"></i>
                        <h3 class="feature-title">Program Prestasi</h3>
                        <p class="feature-desc">Kurikulum terstruktur untuk memaksimalkan potensi siswa dalam kompetisi
                            dan ajang bergengsi.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="1000"
                    data-aos-delay="400">
                    <div class="feature-card">
                        <i class="bi bi-camera-video feature-icon"></i>
                        <h3 class="feature-title">Dokumentasi Profesional</h3>
                        <p class="feature-desc">Portofolio kegiatan dalam format high-quality untuk kebutuhan akademik
                            dan profesional.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="1000"
                    data-aos-delay="600">
                    <div class="feature-card">
                        <i class="bi bi-chat-dots feature-icon"></i>
                        <h3 class="feature-title">Konsultasi Eksklusif</h3>
                        <p class="feature-desc">Sesi konsultasi privat dengan pembina untuk pengembangan bakat yang
                            lebih terarah.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="faq-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="1000">
                <h2 class="section-title mx-auto" style="color: var(--navy);">Informasi Penting</h2>
                <p class="text-muted">Pertanyaan yang sering diajukan tentang program eksklusif kami</p>
            </div>

            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="accordion" id="faqAccordion" data-aos="fade-up" data-aos-duration="1000"
                        data-aos-delay="200">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq1">
                                    Bagaimana sistem seleksi untuk program eksklusif ini?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Program eksklusif kami memiliki proses seleksi bertahap yang mencakup penilaian
                                    minat, bakat, dan komitmen siswa. Tahap pertama adalah pendaftaran online, diikuti
                                    dengan sesi wawancara dengan pembina terkait, dan mungkin tes bakat khusus untuk
                                    beberapa program. Kami berkomitmen untuk memastikan setiap siswa ditempatkan di
                                    program yang paling sesuai dengan potensi mereka.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq2">
                                    Apa keunggulan program ini dibanding ekskul biasa?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Program eksklusif kami menawarkan rasio mentor-siswa yang lebih kecil (maksimal
                                    1:10), kurikulum terstruktur dengan target pencapaian, akses ke fasilitas premium,
                                    pelatihan khusus untuk kompetisi, sertifikat resmi yang diakui industri, serta
                                    kesempatan untuk mengikuti berbagai event bergengsi. Selain itu, kami menyediakan
                                    laporan perkembangan berkala untuk memantau kemajuan siswa.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq3">
                                    Apakah ada biaya tambahan untuk program eksklusif?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Program eksklusif kami memiliki kontribusi operasional yang disesuaikan dengan
                                    kebutuhan masing-masing program. Biaya ini mencakup pelatihan khusus, akses
                                    fasilitas premium, materi pelatihan, seragam khusus, dan pendampingan intensif.
                                    Namun, kami juga menyediakan skema beasiswa untuk siswa berprestasi dengan kondisi
                                    ekonomi terbatas. Informasi detail dapat diperoleh melalui konsultasi dengan tim
                                    kami.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq4">
                                    Bagaimana sistem penilaian dan evaluasi peserta?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Kami menerapkan sistem penilaian komprehensif yang mencakup aspek keterampilan,
                                    kedisiplinan, perkembangan, dan kontribusi dalam kegiatan. Evaluasi dilakukan secara
                                    berkala setiap bulan dengan laporan tertulis, disertai sesi konsultasi personal
                                    dengan pembina. Di akhir program, siswa akan menerima sertifikat dengan penilaian
                                    terperinci yang dapat menjadi nilai tambah untuk portofolio akademik maupun
                                    profesional.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq5">
                                    Apa saja fasilitas yang didapatkan peserta program?
                                </button>
                            </h2>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Peserta program eksklusif mendapatkan akses ke berbagai fasilitas premium termasuk
                                    ruang latihan khusus, peralatan profesional, modul pelatihan eksklusif, seragam
                                    kegiatan, asuransi kegiatan, akses ke webinar dan workshop khusus, konsultasi
                                    pembinaan karir, serta kesempatan untuk mengikuti kompetisi bergengsi dengan biaya
                                    ditanggung sekolah. Fasilitas tambahan disesuaikan dengan kebutuhan masing-masing
                                    program.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
  
