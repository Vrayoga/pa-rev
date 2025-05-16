@extends('layout.MainLayout')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Manajemen Siswa Kelas {{ $kelas->tingkat }} -
                            {{ $kelas->jurusan->nama_jurusan }} {{$kelas->kode_kelas}}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Kelas</a></li>
                                <li class="breadcrumb-item active">Manajemen Siswa</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('kelas.siswa.store', $kelas->id) }}">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-2">
                                        <select name="status" class="form-control" required>
                                            <option value="new">Siswa Baru</option>
                                            <option value="naik">Naik Kelas</option>
                                            <option value="tidak_naik">Tidak Naik</option>
                                            <option value="lulus">Lulus</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                          <label for="manufacturername">Kode kelas</label>
                                        <input id="kode_kelas" name="kode_kelas" type="number" class="form-control" placeholder="Masukkan Kode kelas">
                                        <div class="invalid-feedback">Masukkan kode kelas</div>
                                    </div>
                                    {{-- <div class="col-md-3">
                                        <select id="kelas-filter" class="form-control">
                                            <option value="">Semua Kelas</option>
                                            @php
                                                $uniqueKelas = $siswa
                                                    ->pluck('kelas')
                                                    ->unique()
                                                    ->sort()
                                                    ->values()
                                                    ->all();
                                            @endphp
                                            @foreach ($uniqueKelas as $kelasItem)
                                                <option value="{{ $kelasItem }}">{{ $kelasItem }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="class-code-search" class="form-control"
                                            placeholder="Cari berdasarkan kode kelas (ex: X TKJ 1)">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" id="apply-filter" class="btn btn-secondary waves-effect">
                                            <i class="bx bx-filter-alt me-1"></i> Terapkan Filter
                                        </button>
                                    </div> --}}
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            <i class="bx bx-plus me-1"></i> Tambah Siswa Terpilih
                                        </button>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th width="50px" class="text-center">
                                                    <input type="checkbox" id="select-all">
                                                </th>
                                                <th>No</th>
                                                <th>NISN</th>
                                                <th>Nama Siswa</th>
                                                <th>Kode Kelas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($siswa as $index => $s)
                                                <tr data-kelas="{{ $s->kelas }}">
                                                    <td class="text-center">
                                                        <input type="checkbox" name="siswa_id[]" value="{{ $s->id }}"
                                                            class="student-checkbox">
                                                    </td>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $s->nis_nip }}</td>
                                                    <td>{{ $s->nama_siswa }}</td>
                                                    <td class="kode-kelas">
                                                        {{ $s->kode }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Initialize DataTable with custom search
                var table = $('#datatable').DataTable({
                    dom: '<"top"lf>rt<"bottom"ip>',
                    language: {
                        search: "Cari semua kolom:",
                        searchPlaceholder: "NISN/Nama...",
                        lengthMenu: "Tampilkan _MENU_ data per halaman",
                        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        infoEmpty: "Tidak ada data",
                        zeroRecords: "Data tidak ditemukan",
                        paginate: {
                            previous: "Sebelumnya",
                            next: "Selanjutnya"
                        }
                    },
                    initComplete: function() {
                        $('.dataTables_filter input').addClass('form-control form-control-sm');
                        $('.dataTables_filter label').addClass('form-label');
                    }
                });

                // Custom filtering function for kelas
                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        var row = table.row(dataIndex).node();
                        var kelasValue = $(row).attr('data-kelas');
                        var selectedKelas = $('#kelas-filter').val();
                        var searchText = $('#class-code-search').val().toLowerCase().trim();
                        
                        // Jika tidak ada filter yang aktif, tampilkan semua data
                        if ((selectedKelas === '' || selectedKelas === undefined) && 
                            (searchText === '' || searchText === undefined)) {
                            return true;
                        }
                        
                        // Filter berdasarkan dropdown kelas
                        if (selectedKelas !== '' && selectedKelas !== undefined) {
                            if (kelasValue !== selectedKelas) {
                                return false;
                            }
                        }
                        
                        // Filter berdasarkan pencarian teks
                        if (searchText !== '' && searchText !== undefined) {
                            if (!kelasValue.toLowerCase().includes(searchText)) {
                                return false;
                            }
                        }
                        
                        return true;
                    }
                );

                // Terapkan filter
                function applyFilter() {
                    table.draw(); // Redraw table with filters applied
                    updateSelectAllState(); // Update select all checkbox state
                }

                // Terapkan filter ketika tombol diklik
                $('#apply-filter').click(function() {
                    applyFilter();
                });

                // Terapkan filter saat Enter ditekan di kotak pencarian
                $('#class-code-search').keypress(function(e) {
                    if (e.which === 13) {
                        e.preventDefault();
                        applyFilter();
                    }
                });

                // Reset teks pencarian saat dropdown filter berubah
                $('#kelas-filter').change(function() {
                    if ($(this).val() !== '') {
                        $('#class-code-search').val('');
                    }
                });

                // Reset dropdown filter saat teks pencarian diisi
                $('#class-code-search').keyup(function() {
                    var searchTerm = $(this).val().trim();
                    if (searchTerm !== '') {
                        $('#kelas-filter').val('');
                    }
                });

                // Select all checkbox functionality
                $('#select-all').click(function() {
                    var isChecked = $(this).prop('checked');
                    
                    // Hanya pilih checkbox yang visible setelah filter
                    table.rows({page: 'current'}).nodes().each(function(node) {
                        $(node).find('.student-checkbox').prop('checked', isChecked);
                    });
                });

                // Update status checkbox "Select All"
                function updateSelectAllState() {
                    var totalVisible = table.rows({page: 'current'}).nodes().length;
                    var totalChecked = 0;
                    
                    table.rows({page: 'current'}).nodes().each(function(node) {
                        if ($(node).find('.student-checkbox').prop('checked')) {
                            totalChecked++;
                        }
                    });
                    
                    $('#select-all').prop('checked', totalVisible > 0 && totalChecked === totalVisible);
                }

                // Perbarui checkbox "Select All" saat pindah halaman atau filter diterapkan
                table.on('draw', function() {
                    updateSelectAllState();
                });

                // Perbarui checkbox "Select All" saat checkbox siswa berubah
                $(document).on('change', '.student-checkbox', function() {
                    updateSelectAllState();
                });
            });
        </script>
    @endpush
@endsection