@extends('layoutUser.MainLayout')


@section('contentUser')

    <h3 class="fw-bold">Ekskul</h3>
    <p class="text-muted">Ekstrakurikuler Sekolah SMKN 1 Sumenep</p>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($ekstrakurikulers as $ekskul)
          <div class="col">
            <div class="card">
              <img src="{{ asset('storage/' . $ekskul->Gambar) }}" class="card-img" width="" alt="{{ $ekskul->nama_ekstrakurikuler }}">
              <div class="card-overlay">
                <div class="small-author"><i class="bi bi-clock-fill"></i> {{ $ekskul->Jadwal }}</div>
                <p>{{ \Illuminate\Support\Str::limit($ekskul->Deskripsi, 100, '...') }}</p>
                
                <div class="text-center mt-2">
                    <a href="{{ route('ekstrakurikuler.show', $ekskul->id) }}" class="card-title-button text-decoration-none">
                        {{ $ekskul->nama_ekstrakurikuler }}
                      </a>
                      
                  </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>


  @endsection