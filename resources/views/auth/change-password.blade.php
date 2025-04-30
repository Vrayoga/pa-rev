<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Form Wizard | Skote - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- App js -->
    <script src="assets/js/plugin.js"></script>
</head>

<body>
    <div id="layout-wrapper">
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Basic Wizard</h4>

                                    <form id="wizard-form" action="{{ route('change.password.post') }}" method="POST">
                                        @csrf
                                        <div id="basic-example">
                                            <!-- Change Password Section -->
                                            <h3>Change your password</h3>
                                            <section>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label>Email address</label>
                                                            <input type="text" class="form-control" name="email"
                                                                   value="{{ Auth::user()->email }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="password">Password</label>
                                                            <input type="password" class="form-control" 
                                                                   name="password" id="password" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="password_confirmation">Confirm New Password</label>
                                                            <input type="password" class="form-control" 
                                                                   name="password_confirmation" id="password_confirmation" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>

                                            <!-- Extracurricular Section -->
                                            <h3>Ekstrakurikuler Wajib</h3>
                                            <section>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label>Ekstrakurikuler</label>
                                                            @if($mandatoryEkstra)
                                                                <input type="text" class="form-control" 
                                                                       value="{{ $mandatoryEkstra->nama_ekstrakurikuler }}" readonly>
                                                                <input type="hidden" name="ekstrakurikuler_id" 
                                                                       value="{{ $mandatoryEkstra->id }}">
                                                            @else
                                                                <div class="alert alert-danger">
                                                                    Tidak ada ekstrakurikuler wajib yang terdaftar
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label>Kelas</label>
                                                            <input type="text" class="form-control" 
                                                                   value="{{ $kelas->kelas ?? '' }} {{ $kelas->jurusan ??''}}" readonly>
                                                            <input type="hidden" name="kelas_id" 
                                                                   value="{{ $siswa->id_kelas ?? '' }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label>Nama Lengkap</label>
                                                            <input type="text" class="form-control" 
                                                                   value="{{ Auth::user()->name }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="no_telepon">No telepon</label>
                                                            <input type="text" class="form-control" 
                                                                   name="no_telepon" id="no_telepon" 
                                                                   value="{{ Auth::user()->siswa->no_telepon ?? '' }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="alasan">Alasan</label>
                                                            <input type="text" class="form-control" 
                                                                   name="alasan" id="alasan" 
                                                                   value="Pendaftaran otomatis ekstrakurikuler wajib" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="nomer_wali">Nomer wali</label>
                                                            <input type="text" class="form-control @error('nomer_wali') is-invalid @enderror" 
                                                                   name="nomer_wali" id="nomer_wali" 
                                                                   value="{{ old('nomer_wali') }}" required>
                                                            @error('nomer_wali')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script>
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
        $(document).ready(function() {
            // Initialize form wizard
            $("#basic-example").steps({
                headerTag: "h3",
                bodyTag: "section",
                transitionEffect: "slide",
                enableAllSteps: true,
                enableFinishButton: true,
                labels: {
                    finish: "Submit",
                    next: "Continue",
                    previous: "Back"
                },
                onStepChanging: function(event, currentIndex, newIndex) {
                    // Validate current step before moving to next
                    if (currentIndex === 0) {
                        var password = $("#password").val();
                        var confirmPassword = $("#password_confirmation").val();
                        
                        if (password === "" || confirmPassword === "") {
                            alert("Please fill in all password fields");
                            return false;
                        }
                        
                        if (password !== confirmPassword) {
                            alert("Passwords do not match");
                            return false;
                        }
                    }
                    return true;
                },
                onFinished: function(event, currentIndex) {

            event.preventDefault();
            
            // Kirim form via AJAX
            $.ajax({
                url: $("#wizard-form").attr('action'),
                method: "POST",
                data: $("#wizard-form").serialize(),
                success: function(response) {
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    }
                },
                error: function(xhr) {
                    alert("Error: " + xhr.responseJSON.message);
                }
            });
        }
    });
});
    </script>
</body>
</html>