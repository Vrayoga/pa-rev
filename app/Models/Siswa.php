<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswas';

    // app/Models/Siswa.php
    protected $fillable = [
        'nama_siswa',
        'id_kelas',
        'sekolah_asal',
        'tanggal_lahir',
        'alamat',
        'nis',
        'image',
        'no_telepon',
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
