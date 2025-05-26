@extends('layout.MainLayout')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Import Data Siswa</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('siswa.index') }}">Data Siswa</a></li>
                                <li class="breadcrumb-item active">Import Siswa</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Upload File Excel Siswa</h4>

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('import_errors'))
                                <div class="alert alert-danger" role="alert">
                                    <h4 class="alert-heading">Error Validasi Import!</h4>
                                    <p>Beberapa baris data tidak dapat diimpor. Mohon perbaiki dan coba lagi:</p>
                                    <hr>
                                    <ul>
                                        @foreach (session('import_errors') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <p><strong>Terjadi kesalahan:</strong></p>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="container">
                                <h2>Import Data Siswa</h2>

                                @if (session('import_errors'))
                                    <div class="alert alert-danger">
                                        <h4>Terjadi kesalahan pada import:</h4>
                                        <ul>
                                            @foreach (session('import_errors') as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <form action="{{ route('siswa.import.process') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="file_siswa">File Excel</label>
                                        <input type="file" class="form-control" id="file_siswa" name="file_siswa"
                                            required>
                                        <small class="form-text text-muted">
                                            Format file harus .xlsx, .xls, atau .csv. Maksimal 2MB.
                                        </small>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Import</button>
                                    <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
