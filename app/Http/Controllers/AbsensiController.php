<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Carbon\Carbon;
use App\Models\Pendaftaran;
use App\Models\SesiAbsensi;
use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\JadwalEkstrakurikuler;

class AbsensiController extends Controller
{
    // Tampilan Dashboard Presensi
   


   
    

    // Menampilkan halaman absensi siswa
    public function absensiSiswa()
    {
        $user = Auth::user();

        if (!$user->hasRole('guru')) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses');
        }

        // Ambil sesi absensi aktif milik guru ini
        $sesiAktif = SesiAbsensi::where('guru_id', $user->id)
            ->where('is_active', true)
            ->with(['jadwals.ekstrakurikuler'])
            ->first();

        if (!$sesiAktif) {
            return redirect()->route('dashboardGuru.index')->with('error', 'Tidak ada sesi absensi yang aktif');
        }

        // Ambil data anggota ekstrakurikuler (siswa yang terdaftar)
        $ekstrakurikulerId = $sesiAktif->jadwals->ekstrakurikuler->id;

        // Ambil siswa yang terdaftar di ekstrakurikuler ini (dari tabel pendaftaran)
        $anggota = Pendaftaran::where('ekstrakurikuler_id', $ekstrakurikulerId)
            ->where('status_validasi', 'diterima')
            ->with('user')
            ->get();

        return view('halaman-admin.absensi.siswa', [
            'sesiAktif' => $sesiAktif,
            'anggota' => $anggota
        ]);
    }



    
    
}

