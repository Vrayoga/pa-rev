<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Change Password | SMKN 1 Sumenep</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="SMKN 1 Sumenep Student Portal" name="description" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-smk1.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        :root {
            --primary: #0A3981;
            --secondary: #1da9b4;
            --accent: #f59e0b;
            --light: #f8fafc;
            --dark: #0f172a;
            --gray: #64748b;
            --light-gray: #e2e8f0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fa;
            color: var(--dark);
        }

        .auth-container {
            max-width: 1000px;
            margin: 2rem auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .auth-header {
            background: linear-gradient(135deg, var(--primary) 0%, #1e3a8a 100%);
            color: white;
            padding: 1.5rem;
            text-align: center;
        }

        .auth-header img {
            height: 50px;
            margin-bottom: 1rem;
        }

        .auth-title {
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .auth-subtitle {
            opacity: 0.9;
            font-size: 0.95rem;
        }

        .auth-body {
            padding: 2rem;
        }

        .wizard>.steps {
            margin-bottom: 2rem;
        }

        .wizard>.steps>ul {
            display: flex;
            justify-content: space-between;
            padding: 0;
        }

        .wizard>.steps>ul>li {
            flex: 1;
            position: relative;
            text-align: center;
            list-style: none;
        }

        .wizard>.steps>ul>li:after {
            content: '';
            position: absolute;
            top: 15px;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--light-gray);
            z-index: 1;
        }

        .wizard>.steps>ul>li:first-child:after {
            width: 50%;
            left: 50%;
        }

        .wizard>.steps>ul>li:last-child:after {
            width: 50%;
        }

        .wizard>.steps>ul>li.current:after,
        .wizard>.steps>ul>li.done:after {
            background: var(--primary);
        }

        .wizard>.steps a {
            position: relative;
            z-index: 2;
            display: inline-block;
            padding: 10px 15px;
            background: white;
            border: 2px solid var(--light-gray);
            border-radius: 50px;
            color: var(--gray);
            font-weight: 500;
        }

        .wizard>.steps .current a {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .wizard>.steps .done a {
            background: var(--light);
            border-color: var(--primary);
            color: var(--primary);
        }

        .wizard>.content {
            background: transparent;
            border: none;
            min-height: 300px;
            padding: 0;
        }

        .wizard>.actions {
            margin-top: 2rem;
            display: flex;
            justify-content: space-between;
        }

        .wizard>.actions>ul {
            display: flex;
            gap: 1rem;
            padding: 0;
            margin: 0;
        }

        .wizard>.actions>ul>li {
            list-style: none;
        }

        .wizard>.actions a {
            background: var(--primary);
            color: white;
            border-radius: 8px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
        }

        .wizard>.actions .disabled a {
            background: var(--light-gray);
            color: var(--gray);
        }

        .wizard>.actions .disabled a:hover {
            background: var(--light-gray);
            color: var(--gray);
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-control {
            height: 48px;
            border-radius: 8px;
            border: 1px solid var(--light-gray);
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(10, 57, 129, 0.15);
        }

        .password-toggle {
            position: relative;
        }

        .password-toggle .form-control {
            padding-right: 40px;
        }

        .password-toggle-btn {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray);
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        @media (max-width: 768px) {
            .auth-container {
                margin: 1rem;
                border-radius: 10px;
            }

            .auth-body {
                padding: 1.5rem;
            }

            .wizard>.steps>ul {
                flex-direction: column;
                gap: 1rem;
            }

            .wizard>.steps>ul>li:after {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="auth-container">
        <div class="auth-header">
            <img src="{{ asset('assets/images/logo-smk1.png') }}" alt="SMKN 1 Sumenep Logo">
            <h3 class="auth-title">SMKN 1 SUMENEP</h3>
            <p class="auth-subtitle">Portal Siswa - Mengatur Kata Sandi & Registrasi Ekstrakurikuler</p>
        </div>

        <div class="auth-body">
            <form id="wizard-form" action="{{ route('change.password.post') }}" method="POST">
                @csrf
                <div id="basic-example">
                    <h3>Mengatur Kata Sandi</h3>
                    <section>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email Anda</label>
                                <input type="text" class="form-control" name="email"
                                    value="{{ Auth::user()->email }}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password Baru</label>
                                <div class="password-toggle">
                                    <input type="password" class="form-control" name="password" id="password" required>
                                    <button type="button" class="password-toggle-btn">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi password anda</label>
                                <div class="password-toggle">
                                    <input type="password" class="form-control" name="password_confirmation"
                                        id="password_confirmation" required>
                                    <button type="button" class="password-toggle-btn">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Harap buat kata sandi yang kuat (minimal 6 karakter).
                        </div>
                    </section>

                    <h3>Ekstrakurikuler Wajib</h3>
                    <section>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ekstrakurikuler</label>
                                @if ($mandatoryEkstra)
                                    <input type="text" class="form-control"
                                        value="{{ $mandatoryEkstra->nama_ekstrakurikuler }}" readonly>
                                @else
                                    <div class="alert alert-danger">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        Tidak ada ekstrakurikuler Wajib yang dikonfigurasi.
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kelas</label>
                                <input type="text" class="form-control"
                                    value="{{ $siswa->kelasAktif->kelas->tingkat ?? '' }} {{ $siswa->kelasAktif->kelas->jurusan->nama_jurusan ?? ($kelas->jurusan->nama_jurusan ?? '') }} {{ $siswa->kelasAktif->kelas->kode_kelas ?? '' }}"
                                    readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="no_telepon" class="form-label">No telpon</label>
                                <input type="text" class="form-control" name="no_telepon" id="no_telepon"
                                    value="{{ old('no_telepon', Auth::user()->siswa->no_telepon ?? '') }}" required>
                                @error('no_telepon')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="alasan_wajib" class="form-label">Alasan (Ekstra Wajib)</label>
                                <input type="text" class="form-control" name="alasan_wajib" id="alasan_wajib"
                                    value="Pendaftaran otomatis ekstrakurikuler wajib" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nomer_wali" class="form-label">Nomer Wali</label>
                                <input type="text" class="form-control @error('nomer_wali') is-invalid @enderror"
                                    name="nomer_wali" id="nomer_wali" value="{{ old('nomer_wali') }}"
                                    placeholder="Contoh: 6281234567890" required>
                                @error('nomer_wali')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Gunakan format internasional, contoh: 6281234567890.</div>
                            </div>
                        </div>
                    </section>

                    <h3>Ekstrakurikuler Pilihan (Opsional)</h3>
                    <section>
                        <div class="alert alert-info">
                            Anda dapat memilih maksimal 2 ekstrakurikuler pilihan.
                        </div>
                        <div class="row">
                            <div class="col-12 mb-4">
                                <p class="fw-medium">Pilih Ekstrakurikuler Pilihan (jika diinginkan):</p>
                                <div class="row">
                                    @forelse ($ekstrakurikulerPilihan as $ekstra)
                                        <div class="col-md-6 mb-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="ekstrakurikuler_pilihan_id[]"
                                                            value="{{ $ekstra->id }}"
                                                            id="ekstra_{{ $ekstra->id }}">
                                                        <label class="form-check-label fw-medium"
                                                            for="ekstra_{{ $ekstra->id }}">
                                                            {{ $ekstra->nama_ekstrakurikuler }}
                                                            @if ($ekstra->kuota !== null)
                                                                (Kuota:
                                                                {{-- Assuming you have a method pendaftarAktif() in your Ekstrakurikuler model --}}
                                                                {{ $ekstra->pendaftarAktif() }}/{{ $ekstra->kuota }})
                                                            @endif
                                                        </label>
                                                    </div>
                                                    <div class="mt-2">
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="alasan_pilihan[{{ $ekstra->id }}]"
                                                            placeholder="Alasan (opsional)">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <p>Tidak ada ekstrakurikuler pilihan yang tersedia saat ini.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.password-toggle-btn').click(function() {
                const input = $(this).siblings('input');
                const icon = $(this).find('i');
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            $("#basic-example").steps({
                headerTag: "h3",
                bodyTag: "section",
                transitionEffect: "slide",
                autoFocus: true,
                enableFinishButton: true,
                labels: {
                    finish: "Simpan & Lanjutkan",
                    next: "Lanjut",
                    previous: "Kembali",
                    loading: "Memuat..."
                },
                onStepChanging: function(event, currentIndex, newIndex) {
                    if (newIndex < currentIndex) {
                        return true;
                    }
                    if (currentIndex === 0) {
                        const password = $("#password").val();
                        const confirmPassword = $("#password_confirmation").val();
                        if (password === "" || confirmPassword === "") {
                            alert("Mohon isi kolom Password Baru dan Konfirmasi Password.");
                            $("#password").focus();
                            return false;
                        }
                        if (password.length < 6) {
                            alert("Password minimal harus 6 karakter.");
                            $("#password").focus();
                            return false;
                        }
                        if (password !== confirmPassword) {
                            alert("Password Baru dan Konfirmasi Password tidak cocok.");
                            $("#password_confirmation").focus();
                            return false;
                        }
                    }
                    if (currentIndex === 1) {
                        const nomerWali = $("#nomer_wali").val();
                        const noTeleponSiswa = $("#no_telepon").val();
                        if (!noTeleponSiswa) {
                            alert("Mohon isi No Telepon siswa.");
                            $("#no_telepon").focus();
                            return false;
                        }
                        const phoneRegexSimple = /^62[0-9]{9,13}$/;
                        if (!nomerWali) {
                            alert("Mohon isi Nomer Wali.");
                            $("#nomer_wali").focus();
                            return false;
                        }
                        if (!phoneRegexSimple.test(nomerWali)) {
                            alert(
                                "Format Nomer Wali tidak valid. Gunakan format 62xxxxxxxxxxx (11-15 digit). Contoh: 6281234567890");
                            $("#nomer_wali").focus();
                            return false;
                        }
                    }
                    if (currentIndex === 2) { 
                        const pilihanCount = $('input[name="ekstrakurikuler_pilihan_id[]"]:checked')
                            .length;
                        if (pilihanCount > 2) {
                            alert("Anda hanya dapat memilih maksimal 2 ekstrakurikuler pilihan.");
                            return false;
                        }
                    }
                    return true;
                },
                onFinishing: function(event, currentIndex) {
                    const pilihanCount = $('input[name="ekstrakurikuler_pilihan_id[]"]:checked').length;
                    if (pilihanCount > 2) {
                        alert("Anda hanya dapat memilih maksimal 2 ekstrakurikuler pilihan.");
                        return false; 
                    }
                    return true; 
                },
                onFinished: function(event, currentIndex) {
                    event.preventDefault();
                    $("a[href='#finish']").addClass('disabled').text('Memproses...');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: $("#wizard-form").attr('action'),
                        method: "POST",
                        data: $("#wizard-form").serialize(),
                        success: function(response) {
                            // The fetchNotifications() call here is unlikely to update a separate header
                            // on *this* page before redirect. The update will be visible on the next page.
                            // if (typeof fetchNotifications === 'function') { 
                            //     fetchNotifications(); 
                            // }

                            if (response.redirect) {
                                if (response.message) {
                                    alert(response.message);
                                }
                                window.location.href = response.redirect;
                            } else {
                                alert(response.message || "Proses pendaftaran selesai.");
                                $("a[href='#finish']").removeClass('disabled').text(
                                    'Simpan & Lanjutkan');
                            }
                        },
                        error: function(xhr) {
                            $("a[href='#finish']").removeClass('disabled').text(
                                'Simpan & Lanjutkan');
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                let errorMessages = "Terdapat kesalahan input:\n";
                                $.each(xhr.responseJSON.errors, function(key, value) {
                                    errorMessages += `- ${value.join(', ')}\n`;
                                });
                                alert(errorMessages);
                            } else if (xhr.responseJSON && xhr.responseJSON.message) {
                                alert("Error: " + xhr.responseJSON.message);
                            } else {
                                alert("Terjadi kesalahan pada server. Silakan coba lagi. Status: " +
                                    xhr.statusText);
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>