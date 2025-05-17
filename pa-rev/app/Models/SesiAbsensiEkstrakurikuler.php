<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SesiAbsensiEkstrakurikuler extends Model
{
    protected $table = 'sesi_absen_ekstrakurikuler';

    protected $fillable = [
        'jadwal_id',
        'guru_pembina_id',
        'waktu_buka',
        'waktu_tutup',
        'is_active',
    ];

    public function jadwals()
    {
        return $this->belongsTo(JadwalEkstrakurikuler::class, 'jadwal_id');
    }
    
    public function guruPembina()
    {
        return $this->belongsTo(User::class, 'guru_pembina_id');
    }

    public function jadwalEkstrakurikuler()
    {
        return $this->belongsTo(JadwalEkstrakurikuler::class, 'jadwal_id');
    }


}
