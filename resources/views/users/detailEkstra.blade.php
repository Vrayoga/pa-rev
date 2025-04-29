<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $ekstrakurikuler->nama_ekstrakurikuler }} - SMKN 1 Sumenep</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f8f9fa;
    }
    .navbar {
      background-color: #0A3981;
    }
    .navbar-brand, .nav-link {
      color: #fff !important;
    }
    .section-title {
      font-weight: 700;
      margin-bottom: 1rem;
    }
    .info-box {
      background-color: #fff;
      border-radius: 10px;
      padding: 25px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .info-icon {
      font-size: 1.5rem;
      color: #0A3981;
      margin-right: 10px;
    }
    .share-buttons a {
      font-size: 1.2rem;
    }
  </style>
</head>
<body>

  {{-- Navbar --}}
  <nav class="navbar navbar-expand-lg sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
          <img src="{{ asset('') }}assets/images/logo-smk1.png" width="50" class="me-2" alt="logo">
          Smkn 1 Sumenep
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" href="#">Beranda</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Prestasi</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Artikel</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Hasil PPDB</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Informasi</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Kontak</a></li>
            <li class="nav-item"><a class="btn btn-login" href="/login">Masuk <i class="bi bi-lock-fill"></i></a></li>
          </ul>
        </div>
      </div>
  </nav>

  {{-- Content --}}
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-lg-8">

        {{-- Title --}}
        <h2 class="text-center section-title">{{ $ekstrakurikuler->nama_ekstrakurikuler }}</h2>

        {{-- Image --}}
        <div class="text-center mb-4">
          <img src="{{ asset('storage/' . $ekstrakurikuler->Gambar) }}" alt="{{ $ekstrakurikuler->nama_ekstrakurikuler }}" class="img-fluid rounded shadow-sm" style="max-height: 350px; object-fit: cover;">
        </div>

        {{-- Deskripsi --}}
        <div class="info-box mb-4">
          <h5><i class="bi bi-info-circle-fill info-icon"></i> Deskripsi</h5>
          <p class="text-justify">{!! nl2br(e($ekstrakurikuler->Deskripsi)) !!}</p>
        </div>

        {{-- Jadwal & Informasi --}}
        <div class="info-box mb-4">
          <h5><i class="bi bi-calendar-week info-icon"></i> Informasi Ekstrakurikuler</h5>
          <ul class="list-unstyled mb-0">
            <li class="mb-2"><i class="bi bi-calendar-event info-icon"></i><strong>Jadwal:</strong> {{ $ekstrakurikuler->Jadwal }}</li>
            <li class="mb-2"><i class="bi bi-clock info-icon"></i><strong>Jam:</strong> {{ $ekstrakurikuler->Jam_mulai }} - {{ $ekstrakurikuler->Jam_selesai }}</li>
            <li class="mb-2"><i class="bi bi-geo-alt info-icon"></i><strong>Lokasi:</strong> {{ $ekstrakurikuler->Lokasi }}</li>
            <li class="mb-2"><i class="bi bi-tag-fill info-icon"></i><strong>Kategori:</strong> {{ $ekstrakurikuler->kategori->nama_kategori }}</li>
          </ul>
        </div>

        {{-- Share --}}
        <div class="info-box share-buttons d-flex align-items-center gap-3 justify-content-center">
          <a href="" class="btn btn-primary" target="_blank" title=""><i class="bi bi-fire"></i> Daftar Sekarang</a>
          <a href="{{route ('userSiswa.index')}}" class="btn btn-primary" target="" title="Bagikan ke Facebook"><i class="bi bi-x-lg"></i> Kembali</a>
        </div>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
