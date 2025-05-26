<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    // app/Models/Siswa.php
    protected $fillable = [
        'nis_nip',
        'nama_siswa',
        'email',
        'tempat',
        'tanggal_lahir',
        'kode',
        'jenis_kelamin',
        'agama',
        'no_telepon',
        'tahun_masuk',
        'status',
    ];

    public function user()
{
    return $this->hasOne(User::class, 'nis_nip', 'nis_nip');
}
public function kelas()
{
    return $this->belongsToMany(Kelas::class, 'kelas_siswa', 'id_siswa', 'id_kelas')
                ->withPivot('status', 'is_active', 'tahun_ajaran');
}


public function kelasAktif()
{
    return $this->hasOne(KelasSiswa::class, 'id_siswa')
                ->where('is_active', 'aktif')
                ->with('kelas');
}

}
