<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $fillable = [
        'sesi_absen_id',
        'pendaftaran_id',
        'siswa_id',
        'status',
        'catatan',
    ];

    public function sesiAbsen()
    {
        return $this->belongsTo(SesiAbsensi::class, 'sesi_absen_id');
    }

    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
}
