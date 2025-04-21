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
                                    <h5 class="text-secondary fw-normal mb-4">Welcome back admin !</h5>
                                    <form class="forms-sample" action="/register_action" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="userEmail" class="form-label">Username</label>
                                            <input type="text" class="form-control" name="username" id="username"
                                                placeholder="Username" value="{{ old('username') }}">
                                            @error('username')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="userEmail" class="form-label">Nama</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Nama Lengkap" value="{{ old('name') }}">
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="userEmail" class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control" name="tanggal_lahir"
                                                id="tanggal_lahir" placeholder="Tanggal Lahir"
                                                value="{{ old('tanggal_lahir') }}">
                                            @error('tanggal_lahir')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="userEmail" class="form-label">Email address</label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Email" value="{{ old('email') }}">
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="userEmail" class="form-label">Nomer Telpon</label>
                                            <input type="number" class="form-control" name="no_telepon" id="no_telepon"
                                                placeholder="Nomer Telpon" value="{{ old('no_telepon') }}">
                                            @error('no_telepon')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="userEmail" class="form-label">NIS</label>
                                            <input type="text" class="form-control" name="nis" id="nis"
                                                placeholder="NIS" value="{{ old('nis') }}">
                                            @error('nis')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="userPassword" class="form-label">Password</label>
                                            <input type="password" class="form-control" name="password" id="password"
                                                autocomplete="current-password" placeholder="Password">
                                            @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div>
                                            <button type="submit"
                                                class="btn btn-primary me-2 mb-2 mb-md-0 text-white">Register</button>
                                            <button type="button"
                                                class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                                                <i class="btn-icon-prepend" data-feather="github"></i>
                                                Login with Github
                                            </button>
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
