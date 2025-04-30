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
                @if($ekstrakurikulers->isEmpty())
                    <div class="alert alert-warning">
                        Tidak ada ekstrakurikuler yang tersedia untuk pendaftaran saat ini.
                    </div>
                @else
                    <form action="{{ route('ekstraDaftar.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="ekstrakurikuler_id" class="form-label">Ekstrakurikuler</label>
                            <select class="form-select" id="ekstrakurikuler_id" name="ekstrakurikuler_id" required>
                                <option value="" disabled selected>Pilih Ekstrakurikuler</option>
                                @foreach($ekstrakurikulers as $ekstra)
                                <option value="{{ $ekstra->id }}">
                                    {{ $ekstra->nama_ekstrakurikuler }} 
                                    ({{ $ekstra->jenis }})
                                    @if($ekstra->stok)
                                        - Kuota tersedia: {{ $ekstra->stok }}
                                    @endif
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="alasan" class="form-label">Alasan</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="3" placeholder="Jelaskan alasan Anda mendaftar" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="nomer_wali" class="form-label">Nomor Wali</label>
                            <input type="text" class="form-control" id="nomer_wali" name="nomer_wali" placeholder="Masukkan nomor telepon wali" required>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('userSiswa.index') }}" class="btn btn-light">Close</a>
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