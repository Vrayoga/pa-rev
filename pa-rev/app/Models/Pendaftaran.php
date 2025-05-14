<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Ekstrakurikuler;
use App\Models\Kelas;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';
    protected $fillable = [
        'users_id',
        'ekstrakurikuler_id',
        'kelas_id',
        'nama_lengkap',
        'no_telepon',
        'alasan',
        'nomer_wali',
        'status_validasi',
         'validator_id',
    ];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function ekstrakurikuler()
    {
        return $this->belongsTo(Ekstrakurikuler::class, 'ekstrakurikuler_id', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function validator()
{
    return $this->belongsTo(User::class, 'validator_id');
}

public function absensi()
{
    return $this->hasMany(Absensi::class, 'pendaftaran_id');
}

// Contoh jika foreign key bernama id_siswa
public function siswa()
{
    return $this->belongsTo(Siswa::class, 'id_siswa');
}
}