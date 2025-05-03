<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwalEkstrakurikuler extends Model
{
    use HasFactory;

    protected $table = 'jadwal_ekstrakurikuler';

    protected $fillable = [
        'ekstrakurikuler_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];

    public function ekstrakurikuler()
    {
        return $this->belongsTo(Ekstrakurikuler::class, 'ekstrakurikuler_id');
    }
}
