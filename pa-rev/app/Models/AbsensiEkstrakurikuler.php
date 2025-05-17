<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AbsensiEkstrakurikuler extends Model
{
    use HasFactory;

    protected $table = 'absensi_ekstrakurikuler';

    protected $fillable = [
        'sesi_absen_ekstrakurikuler_id',
        'pendaftaran_id',
        'siswa_id',
        'status',
        'catatan',
    ];

    public function sesiAbsen()
    {
        return $this->belongsTo(SesiAbsensiEkstrakurikuler::class, 'sesi_absen_ekstrakurikuler_id');
    }

    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
}
