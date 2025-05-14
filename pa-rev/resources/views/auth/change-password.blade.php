<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Change Password | SMKN 1 Sumenep</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="SMKN 1 Sumenep Student Portal" name="description" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-smk1.png') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- jQuery Steps CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.css">
    
    <!-- Custom CSS -->
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

        /* Wizard Form Styling */
        .wizard > .steps {
            margin-bottom: 2rem;
        }

        .wizard > .steps > ul {
            display: flex;
            justify-content: space-between;
            padding: 0;
        }

        .wizard > .steps > ul > li {
            flex: 1;
            position: relative;
            text-align: center;
            list-style: none;
        }

        .wizard > .steps > ul > li:after {
            content: '';
            position: absolute;
            top: 15px;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--light-gray);
            z-index: 1;
        }

        .wizard > .steps > ul > li:first-child:after {
            width: 50%;
            left: 50%;
        }

        .wizard > .steps > ul > li:last-child:after {
            width: 50%;
        }

        .wizard > .steps > ul > li.current:after,
        .wizard > .steps > ul > li.done:after {
            background: var(--primary);
        }

        .wizard > .steps a {
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

        .wizard > .steps .current a {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .wizard > .steps .done a {
            background: var(--light);
            border-color: var(--primary);
            color: var(--primary);
        }

        .wizard > .content {
            background: transparent;
            border: none;
            min-height: 300px;
            padding: 0;
        }

        .wizard > .actions {
            margin-top: 2rem;
            display: flex;
            justify-content: space-between;
        }

        .wizard > .actions > ul {
            display: flex;
            gap: 1rem;
            padding: 0;
            margin: 0;
        }

        .wizard > .actions > ul > li {
            list-style: none;
        }

        .wizard > .actions a {
            background: var(--primary);
            color: white;
            border-radius: 8px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
        }

        .wizard > .actions .disabled a {
            background: var(--light-gray);
            color: var(--gray);
        }

        .wizard > .actions .disabled a:hover {
            background: var(--light-gray);
            color: var(--gray);
        }

        /* Form Styling */
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

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .auth-container {
                margin: 1rem;
                border-radius: 10px;
            }
            
            .auth-body {
                padding: 1.5rem;
            }
            
            .wizard > .steps > ul {
                flex-direction: column;
                gap: 1rem;
            }
            
            .wizard > .steps > ul > li:after {
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
            <p class="auth-subtitle">Student Portal - Change Password & Extracurricular Registration</p>
        </div>
        
        <div class="auth-body">
            <form id="wizard-form" action="{{ route('change.password.post') }}" method="POST">
                @csrf
                <div id="basic-example">
                    <!-- Step 1: Change Password -->
                    <h3>Change Password</h3>
                    <section>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email address</label>
                                <input type="text" class="form-control" name="email"
                                       value="{{ Auth::user()->email }}" readonly>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <div class="password-toggle">
                                    <input type="password" class="form-control" 
                                           name="password" id="password" required>
                                    <button type="button" class="password-toggle-btn">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <div class="password-toggle">
                                    <input type="password" class="form-control" 
                                           name="password_confirmation" id="password_confirmation" required>
                                    <button type="button" class="password-toggle-btn">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Please create a strong password with at least 8 characters including numbers and special characters.
                        </div>
                    </section>

                    <!-- Step 2: Mandatory Extracurricular -->
                    <h3>Mandatory Extracurricular</h3>
                    <section>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Extracurricular</label>
                                @if($mandatoryEkstra)
                                    <input type="text" class="form-control" 
                                           value="{{ $mandatoryEkstra->nama_ekstrakurikuler }}" readonly>
                                    <input type="hidden" name="ekstrakurikuler_id" 
                                           value="{{ $mandatoryEkstra->id }}">
                                @else
                                    <div class="alert alert-danger">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        No mandatory extracurricular registered
                                    </div>
                                @endif
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Class</label>
                                <input type="text" class="form-control" 
                                       value="{{ $kelas->kelas ?? '' }} {{ $kelas->jurusan ??''}}" readonly>
                                <input type="hidden" name="kelas_id" 
                                       value="{{ $siswa->id_kelas ?? '' }}">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" 
                                       value="{{ Auth::user()->name }}" readonly>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="no_telepon" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" 
                                       name="no_telepon" id="no_telepon" 
                                       value="{{ Auth::user()->siswa->no_telepon ?? '' }}" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="alasan" class="form-label">Reason</label>
                                <input type="text" class="form-control" 
                                       name="alasan" id="alasan" 
                                       value="Automatic registration for mandatory extracurricular" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="nomer_wali" class="form-label">Guardian's Phone Number</label>
                                <input type="text" class="form-control @error('nomer_wali') is-invalid @enderror" 
                                       name="nomer_wali" id="nomer_wali" 
                                       value="{{ old('nomer_wali') }}" required>
                                @error('nomer_wali')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </section>

                    <!-- Step 3: Optional Extracurricular -->
                    <h3>Optional Extracurricular</h3>
                    <section>
                        <div class="row">
                            <div class="col-12 mb-4">
                                <p class="fw-medium">Select optional extracurricular (if desired):</p>
                                <div class="row">
                                    @foreach($ekstrakurikulerPilihan as $ekstra)
                                        <div class="col-md-6 mb-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" 
                                                               name="ekstrakurikuler_pilihan_id[]" 
                                                               value="{{ $ekstra->id }}" 
                                                               id="ekstra_{{ $ekstra->id }}">
                                                        <label class="form-check-label fw-medium" for="ekstra_{{ $ekstra->id }}">
                                                            {{ $ekstra->nama_ekstrakurikuler }}
                                                        </label>
                                                    </div>
                                                    <div class="mt-2">
                                                        <input type="text" class="form-control" 
                                                               name="alasan_pilihan[{{ $ekstra->id }}]" 
                                                               placeholder="Reason (optional)">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery Steps -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js"></script>
    
    <!-- Custom Script -->
    <script>
        $(document).ready(function() {
            // Password toggle functionality
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
                        const password = $("#password").val();
                        const confirmPassword = $("#password_confirmation").val();
                        
                        if (password === "" || confirmPassword === "") {
                            alert("Please fill in all password fields");
                            return false;
                        }
                        
                        if (password.length < 8) {
                            alert("Password must be at least 8 characters long");
                            return false;
                        }
                        
                        if (password !== confirmPassword) {
                            alert("Passwords do not match");
                            return false;
                        }
                    }
                    
                    if (currentIndex === 1) {
                        const nomerWali = $("#nomer_wali").val();
                        if (!nomerWali) {
                            alert("Please enter guardian's phone number");
                            return false;
                        }
                    }
                    
                    return true;
                },
                onFinished: function(event, currentIndex) {
                    event.preventDefault();
                    
                    // Submit form via AJAX
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
                            if (response.redirect) {
                                window.location.href = response.redirect;
                            }
                        },
                        error: function(xhr) {
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                alert("Error: " + xhr.responseJSON.message);
                            } else {
                                alert("An error occurred. Please try again.");
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>