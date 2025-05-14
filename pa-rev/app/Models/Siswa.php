<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    // app/Models/Siswa.php
    protected $fillable = [
        'nisn',
        'nama_siswa',
        'email',
        'tempat',
        'tanggal_lahir',
        'kelas',
        'jenis_kelamin',
        'agama',
        'no_telepon',
        'tahun_masuk',
    ];

    public function user()
{
    return $this->hasOne(User::class, 'nis', 'nis');
}
public function kelas()
{
    return $this->belongsTo(Kelas::class, 'id_kelas');
}
}
