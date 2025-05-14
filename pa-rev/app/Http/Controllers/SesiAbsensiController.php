<?php

namespace App\Http\Controllers;

use App\Models\SesiAbsensi;
use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\JadwalEkstrakurikuler;

class SesiAbsensiController extends Controller
{

    public function dashboardPresensi()
    {
        $user = Auth::user();

        if (!$user->hasRole('guru')) {
            return redirect()->back()->with('error', 'Akses hanya untuk guru');
        }

        // Konversi hari ke format Indonesia
        $hariIni = strtolower(now()->isoFormat('dddd'));
        $hariMap = [
            'monday' => 'senin',
            'tuesday' => 'selasa',
            'wednesday' => 'rabu',
            'thursday' => 'kamis',
            'friday' => 'jumat',
            'saturday' => 'sabtu',
            'sunday' => 'minggu'
        ];
        $hariIni = $hariMap[$hariIni] ?? $hariIni;

        // Ambil ekstrakurikuler beserta semua jadwal dan sesi absensinya
        $ekstraGuru = Ekstrakurikuler::where('id_users', $user->id)
            ->with(['jadwals' => function ($q) use ($hariIni) {
                $q->where('hari', $hariIni)
                    ->with(['sesiAbsen' => function ($s) {
                        $s->whereDate('waktu_buka', now()->toDateString())
                            ->latest();
                    }]);
            }])
            ->get();

        // Filter hanya ekstra yang memiliki jadwal di hari ini
        $ekstraGuru = $ekstraGuru->filter(function ($ekstra) {
            return $ekstra->jadwals->isNotEmpty();
        });

        return view('halaman-admin.guru', [
            'ekstraGuru' => $ekstraGuru,
            'hariIni' => ucfirst($hariIni)
        ]);
    }
    
     // Membuka sesi absen baru
     public function bukaAbsen(Request $request)
     {
         $user = Auth::user();
     
         if (!$user->hasRole('guru')) {
             return redirect()->back()->with('error', 'Anda tidak memiliki akses');
         }
     
         $jadwalId = $request->input('jadwal_id');
     
         if (!$jadwalId) {
             return redirect()->back()->with('error', 'ID Jadwal tidak ditemukan');
         }
     
         try {
             // Validasi jadwal
             $jadwal = JadwalEkstrakurikuler::findOrFail($jadwalId);
             $ekstra = Ekstrakurikuler::findOrFail($jadwal->ekstrakurikuler_id);
     
             // Pastikan guru mengajar ekstrakurikuler ini
             if ($ekstra->id_users != $user->id) {
                 return redirect()->back()->with('error', 'Anda tidak mengajar ekstrakurikuler ini');
             }
     
             // Cek apakah sudah ada sesi yang masih aktif
             $sesiAktif = SesiAbsensi::where('jadwal_id', $jadwalId)
                 ->where('is_active', true)
                 ->first();
     
             // Cek apakah guru sudah membuka sesi hari ini
             $sesiHariIni = SesiAbsensi::where('jadwal_id', $jadwalId)
                 ->whereDate('waktu_buka', now()->toDateString())
                 ->where('guru_id', $user->id)
                 ->first();
     
             if ($sesiHariIni) {
                 return redirect()->route('absensi.siswa')->with('info', 'Anda sudah membuka sesi absensi hari ini.');
             }
     
             // Buat sesi absensi baru
             $sesi = SesiAbsensi::create([
                 'jadwal_id' => $jadwalId,
                 'guru_id' => $user->id,
                 'waktu_buka' => now(),
                 'is_active' => true
             ]);
     
             // Set session
             $request->session()->put([
                 'has_opened_attendance' => true,
                 'absensi_data' => [
                     'sesi_id' => $sesi->id,
                     'waktu_buka' => $sesi->waktu_buka->toDateTimeString()
                 ]
             ]);
         
             // Logging
             Log::info('Absensi dibuka', [
                 'user_id' => $user->id,
                 'sesi_id' => $sesi->id,
                 'session_set' => session('has_opened_attendance')
             ]);
     
             return redirect()->route('absensi.siswa')
                    ->with('success', 'Sesi absensi berhasil dibuka');
     
         } catch (\Exception $e) {
             Log::error('Error saat membuka sesi absensi: ' . $e->getMessage());
             return redirect()->back()->with('error', 'Terjadi kesalahan saat membuka sesi absensi. ' . $e->getMessage());
         }
     }

     ///tutup absensi bagian admin(guru)
    public function tutupAbsen(Request $request)
    {
        $user = Auth::user();
    
        if (!$user->hasRole('guru')) {
            return redirect()->back()->with('error', 'Hanya guru yang dapat menutup absensi');
        }
    
        $jadwalId = $request->input('jadwal_id');
    
        // Cari sesi absen aktif berdasarkan jadwal_id
        $sesiAktif = SesiAbsensi::where('jadwal_id', $jadwalId)
            ->where('is_active', true)
            ->first();
    
        if (!$sesiAktif) {
            return redirect()->back()->with('error', 'Tidak ada sesi absen aktif untuk jadwal ini');
        }
    
        // Pastikan hanya guru yang membuka sesi yang dapat menutupnya
        if ($sesiAktif->guru_id != $user->id) {
            return redirect()->back()->with('error', 'Anda tidak berhak menutup sesi ini');
        }
    
        // Update sesi absen menjadi tidak aktif dan catat waktu tutup
        $sesiAktif->update([
            'waktu_tutup' => now(),
            'is_active' => false
        ]);
    
        // Hapus session absensi yang telah dibuka
        session()->forget(['has_opened_attendance', 'absensi_data']);

        // Redirect atau beri pesan jika perlu
        return redirect()->route('dashboardGuru.index')->with('success', 'Sesi absen berhasil ditutup.');
    }

}
