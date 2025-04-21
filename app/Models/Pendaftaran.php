<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    ];
}
