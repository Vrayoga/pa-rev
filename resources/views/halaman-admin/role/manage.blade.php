@extends('layout.MainLayout')  
@section('content')  

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Manage Permissions untuk Role: {{ $role->name }}</h4>
                    </div>
                    <div class="card-body">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#">Roles</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Manage Permissions</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Pilih permissions untuk role : {{ $role->name }}</h5>
                        
                        <!-- Add Select/Deselect All buttons -->
                        <div class="mb-3 mt-2">
                            <button type="button" class="btn btn-sm btn-primary" id="selectAll">Select All</button>
                            <button type="button" class="btn btn-sm btn-secondary ml-2" id="deselectAll">Deselect All</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('roles.update-permissions', $role->id) }}">
                            @csrf                                                          
                            <div class="row">
                                @foreach($permissions as $permission)                                 
                                    <div class="col-md-3 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input permission-checkbox" type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                            <label class="form-check-label">{{ $permission->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">Simpan Permissions</button>
                                <a href="/role" class="btn btn-secondary ml-2">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllBtn = document.getElementById('selectAll');
            const deselectAllBtn = document.getElementById('deselectAll');
            const checkboxes = document.querySelectorAll('.permission-checkbox');
            
            selectAllBtn.addEventListener('click', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = true;
                });
            });
            
            deselectAllBtn.addEventListener('click', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
            });
        });
    </script>
@endsection