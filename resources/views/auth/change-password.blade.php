@extends('layout.AuthLayout')

@section('Auth')
    <div class="page-wrapper full-page">
        <div class="page-content d-flex align-items-center justify-content-center">

            <div class="row w-100 mx-0 auth-page">
                <div class="col-md-10 col-lg-8 col-xl-6 mx-auto">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-4 pe-md-0">
                                <div class="auth-side-wrapper">

                                </div>
                            </div>
                            <div class="col-md-8 ps-md-0">
                                <div class="auth-form-wrapper px-4 py-5">
                                    <a href="#" class="nobleui-logo d-block mb-2">SMKN 1<span>SUMENEP</span></a>
                                    <h5 class="text-secondary fw-normal mb-4">Change your password.</h5>

                                    <form method="POST" action="/home-post" class="forms-sample">
                                        @csrf

                                        <!-- Email -->
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                value="{{ Auth::user()->email }}" readonly>
                                        </div>

                                        <!-- Password Baru -->
                                        <div class="mb-3">
                                            <label for="password" class="form-label">New Password</label>
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="Enter new password" required>
                                        </div>

                                        <!-- Konfirmasi Password -->
                                        <div class="mb-3">
                                            <label for="password_confirmation" class="form-label">Confirm New
                                                Password</label>
                                            <input type="password" class="form-control" name="password_confirmation"
                                                id="password_confirmation" placeholder="Repeat new password" required>
                                        </div>

                                        <!-- Submit -->
                                        <div>
                                            <button type="submit"
                                                class="btn btn-primary me-2 mb-2 mb-md-0 text-white">Simpan</button>
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
@endsection
