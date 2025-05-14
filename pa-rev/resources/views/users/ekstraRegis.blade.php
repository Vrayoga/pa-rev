@extends('layoutUser.MainLayout')

@section('contentUser')
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Pendaftaran Ekstrakurikuler</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                
                @if(session('warning'))
                <div class="alert alert-warning">
                    {{ session('warning') }}
                </div>
                @endif
                
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                
                @if(isset($pendingRegistrations) && $pendingRegistrations->isNotEmpty())
                <div class="alert alert-warning">
                    <h5><i class="fas fa-exclamation-triangle"></i> Menunggu Validasi</h5>
                    <p>Anda memiliki pendaftaran yang sedang menunggu validasi:</p>
                    <ul class="list-unstyled">
                        @foreach($pendingRegistrations as $pending)
                        <li>
                            <i class="fas fa-circle-notch fa-spin me-2"></i>
                            <strong>{{ $pending->ekstrakurikuler->nama_ekstrakurikuler }}</strong>
                            <span class="badge bg-warning text-dark">Menunggu Validasi</span>
                        </li>
                        @endforeach
                    </ul>
                    <hr>
                    <p class="mb-0">
                        Anda tidak dapat mendaftar ekstrakurikuler baru sampai pendaftaran di atas divalidasi oleh guru pembimbing.
                    </p>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('userSiswa.index') }}" class="btn btn-light">Kembali</a>
                </div>
                @elseif($ekstrakurikulers->isEmpty())
                    <div class="alert alert-warning">
                        Tidak ada ekstrakurikuler yang tersedia untuk pendaftaran saat ini.
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('userSiswa.index') }}" class="btn btn-light">Kembali</a>
                    </div>
                @else
                    <form id="pendaftaranForm" action="{{ route('ekstraDaftar.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="ekstrakurikuler_id" class="form-label">Ekstrakurikuler</label>
                            <select class="form-select @error('ekstrakurikuler_id') is-invalid @enderror" id="ekstrakurikuler_id" name="ekstrakurikuler_id" required>
                                <option value="" disabled selected>Pilih Ekstrakurikuler</option>
                                @foreach($ekstrakurikulers as $ekstra)
                                @php
                                    $isRegistered = isset($registeredEkstras) && in_array($ekstra->id, $registeredEkstras);
                                    $pendaftarDiterima = App\Models\Pendaftaran::where('ekstrakurikuler_id', $ekstra->id)
                                                       ->where('status_validasi', 'diterima')
                                                       ->count();
                                    $sisaKuota = $ekstra->jenis == 'wajib' ? 'Tak Terbatas' : 
                                              ($ekstra->kuota === null ? 'Tak Terbatas' : ($ekstra->kuota - $pendaftarDiterima));
                                @endphp
                                <option value="{{ $ekstra->id }}" {{ $isRegistered ? 'disabled' : '' }} 
                                        {{ old('ekstrakurikuler_id') == $ekstra->id ? 'selected' : '' }}>
                                    {{ $ekstra->nama_ekstrakurikuler }} 
                                    ({{ ucfirst($ekstra->jenis) }})
                                    - Sisa Kuota: {{ is_numeric($sisaKuota) ? $sisaKuota : $sisaKuota }}
                                    {{ $isRegistered ? '(Sudah Terdaftar)' : '' }}
                                </option>
                                @endforeach
                            </select>
                            @error('ekstrakurikuler_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="alasan" class="form-label">Alasan</label>
                            <textarea class="form-control @error('alasan') is-invalid @enderror" id="alasan" name="alasan" rows="3" placeholder="Jelaskan alasan Anda mendaftar" required>{{ old('alasan') }}</textarea>
                            @error('alasan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nomer_wali" class="form-label">Nomor Wali</label>
                            <input type="text" class="form-control @error('nomer_wali') is-invalid @enderror" id="nomer_wali" name="nomer_wali" placeholder="Masukkan nomor telepon wali" value="{{ old('nomer_wali') }}" required>
                            @error('nomer_wali')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('userSiswa.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </div>
                    </form>
                @endif
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

@endsection

@if(request('modal') === 'daftar')
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      var myModal = new bootstrap.Modal(document.getElementById('exampleModalScrollable'));
      myModal.show();

      // Menghapus parameter query dari URL setelah modal dibuka
      if (history.replaceState) {
        const cleanUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
        history.replaceState(null, null, cleanUrl);
      }
    });
  </script>
@endif
