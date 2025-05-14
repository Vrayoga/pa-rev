<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'kelas',
        'id_jurusan',
        'kode_kelas',
        'id_users'
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }


    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'kelas_siswa', 'id_kelas', 'id_siswa');
    }
}
