<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ekskul-SMKN 1 Sumenep</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{asset ('')}}assets/css/app.min.css">
 

</head>
<body>
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
          <li>
            <a href="{{ route('daftar.create', ['modal' => 'daftar']) }}" class="btn btn-primary waves-effect waves-light">
              Daftar
            </a>
          </li>
          <li class="nav-item"><a class="nav-link" href="#">Prestasi</a></li>
          <li class="nav-item"><a class="nav-link" href="https://smk1sumenep.sch.id/?post_type=ekskul">Berita</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Kontak</a></li>
            @auth
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              {{-- <li><a class="dropdown-item" href="{{ route('profile') }}">Profil</a></li> --}}
              <li><hr class="dropdown-divider"></li>
              <li>
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item">Keluar</button>
              </form>
              </li>
            </ul>
            </li>
            @else
            <li class="nav-item"><a class="btn btn-login" href="/login">Masuk <i class="bi bi-lock-fill"></i></a></li>
            @endauth
        </ul>
      </div>
    </div>
  </nav>

  <section class="container hero-section">
 @yield('contentUser')
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
