<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SesiAbsensi extends Model
{
    protected $table = 'sesi_absen';

    protected $fillable = [
        'jadwal_id',
        'guru_id',
        'waktu_buka',
        'waktu_tutup',
        'is_active',
    ];

    public function jadwals()
    {
        return $this->belongsTo(JadwalEkstrakurikuler::class, 'jadwal_id');
    }
    
    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function jadwalEkstrakurikuler()
    {
        return $this->belongsTo(JadwalEkstrakurikuler::class, 'jadwal_id');
    }


}
