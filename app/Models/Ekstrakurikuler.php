<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    use HasFactory;

    protected $table = 'ekstrakurikuler';

    protected $fillable = [
        'nama_ekstrakurikuler',
        'Gambar',
        'Jadwal',
        'Deskripsi',
        'id_kategori',
        'Jam_mulai',
        'Jam_selesai',
        'Lokasi',
        'Periode',
        'jenis',
        'kuota',
        'id_users',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class);
    }
    public function jadwals()
    {
        return $this->hasMany(JadwalEkstrakurikuler::class, 'ekstrakurikuler_id');
    }


    public function sesiAbsen()
    {
        return $this->hasMany(SesiAbsensi::class, 'jadwal_id');
    }
}
