<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswas';

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
}
