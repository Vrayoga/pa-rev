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
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}
