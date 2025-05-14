<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'nis',
        'email_verified_at', 
    ];
    
    public function siswa()
{
    return $this->belongsTo(Siswa::class, 'nis', 'nis');
}

public function ekstrakurikuler()
{
    return $this->hasMany(Ekstrakurikuler::class, 'id_users'); // Sesuaikan foreign key
}

public function pendaftaran()
{
    return $this->hasMany(Pendaftaran::class);
}
}
