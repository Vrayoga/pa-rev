@extends('layout.MainLayout')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Data logbook</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Create</a></li>
                                <li class="breadcrumb-item active">Data logbook</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">SMKN 1 SUMENEP</h4>
                            <p class="card-title-desc">Data Logbook</p>

                            <form action="{{ route('logbook.store') }}" class="needs-validation" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="ekstrakurikuler">Ekstrakurikuler</label>
                                            <select id="ekstrakurikuler_id" name="ekstrakurikuler_id" class="form-control"
                                                required>
                                                <option value="" disabled selected>Pilih Ekstrakurikuler</option>
                                                @foreach ($ekstrakurikuler as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_ekstrakurikuler }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="manufacturername">Kegiatan</label>
                                            <input id="Kegiatan" name="Kegiatan" type="text" class="form-control"
                                                placeholder="Masukkan Kegiatan" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="Tanggal">Tanggal Kegiatan</label>
                                            <input id="Tanggal" name="Tanggal" type="date" class="form-control"
                                                value="{{ now()->toDateString() }}" min="{{ now()->toDateString() }}"
                                                required>
                                        </div>

                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="Jam_mulai">Jam mulai</label>
                                            <input id="Jam_mulai" name="Jam_mulai" type="time" class="form-control"
                                                placeholder="Masukkan jam mulai" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="Jam_selesai">Jam selesai</label>
                                            <input id="Jam_selesai" name="Jam_selesai" type="time" class="form-control"
                                                placeholder="Masukkan jam selesai" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="Foto_kegiatan">Foto kegiatan</label>
                                            <input id="Foto_kegiatan" name="Foto_kegiatan" type="file"
                                                class="form-control" placeholder="Masukkan jam selesai" required>
                                        </div>

                                        <!-- Hidden field for sesi_id -->
                                        <input type="hidden" id="sesi_id" name="sesi_id">
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap gap-2">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save
                                        Changes</button>
                                    <a href="/logbook" class="btn btn-secondary waves-effect waves-light">Cancel</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Debug: Tampilkan data mapping di console
            console.log('Sesi Mapping Data:', @json($sesiMapping));

            const sesiMapping = @json($sesiMapping);
            const ekstrakurikulerSelect = document.getElementById('ekstrakurikuler_id');
            const jamMulaiInput = document.getElementById('Jam_mulai');
            const sesiIdInput = document.getElementById('sesi_id');

            ekstrakurikulerSelect.addEventListener('change', function() {
                const selectedEkstraId = this.value;
                console.log('Ekstrakurikuler selected:', selectedEkstraId);

                if (sesiMapping[selectedEkstraId]) {
                    console.log('Found session data:', sesiMapping[selectedEkstraId]);

                    // Set jam mulai
                    jamMulaiInput.value = sesiMapping[selectedEkstraId].waktu_buka;
                    console.log('Set Jam Mulai to:', jamMulaiInput.value);

                    // Set sesi_id
                    sesiIdInput.value = sesiMapping[selectedEkstraId].sesi_id;
                    console.log('Set Sesi ID to:', sesiIdInput.value);

                    // Set jam selesai (jam mulai + 2 jam)
                    const [hours, minutes] = sesiMapping[selectedEkstraId].waktu_buka.split(':');
                    const endTime = new Date();
                    endTime.setHours(parseInt(hours) + 2, parseInt(minutes));

                    const formattedEndTime = endTime.getHours().toString().padStart(2, '0') + ':' +
                        endTime.getMinutes().toString().padStart(2, '0');
                    document.getElementById('Jam_selesai').value = formattedEndTime;
                    console.log('Set Jam Selesai to:', formattedEndTime);
                } else {
                    console.log('No session data found for this ekstrakurikuler');
                    jamMulaiInput.value = '';
                    sesiIdInput.value = '';
                    document.getElementById('Jam_selesai').value = '';
                }
            });
        });
    </script>
@endsection
