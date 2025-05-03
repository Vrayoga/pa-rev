<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ekskul-SMKN 1 Sumenep</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{asset ('')}}assets/css/app.min.css">
 <style>
  /* css awal ekstra */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #ffffff;
  }

  .navbar {
    background-color: #0A3981;
  }

  .nav-link,
  .navbar-brand {
    color: white;
    font-weight: 500;
  }

  .nav-link:hover {
    color: #e0f7fa;
  }

  .btn-login {
    background-color: #fff;
    color: #1da9b4;
    font-weight: 500;
    border-radius: 50px;
    padding: 5px 30px;
  }

  .hero-section {
    padding: 60px 0 20px;
  }

  .card {
    border: none;
    border-radius: 20px;
    overflow: hidden;
    position: relative;
  }

  .card img {
    height: 200px;
    object-fit: cover;
    width: 100%;
  }

  .card-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.4);
    color: white;
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
  }

  .card-title-button {
    background: white;
    color: black;
    border-radius: 20px;
    padding: 5px 20px;
    text-align: center;
    margin-top: 10px;
    font-weight: 600;
    width: fit-content;
  }

  .small-author {
    font-size: 14px;
    margin-bottom: 5px;
  }

  /* end tampilan userEkstra */

 </style>

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
              <form action="{{ route('logout') }}" method="">
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
