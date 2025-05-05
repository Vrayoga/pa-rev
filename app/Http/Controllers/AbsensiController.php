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

            // Cek apakah guru sudah membuka sesi hari ini (aktif atau tidak)
            $sesiHariIni = SesiAbsensi::where('jadwal_id', $jadwalId)
                ->whereDate('waktu_buka', now()->toDateString())
                ->where('guru_id', $user->id)
                ->first();

            if ($sesiHariIni) {
                return redirect()->route('absensi.siswa')->with('info', 'Anda sudah membuka sesi absensi hari ini.');
            }

            // Buat sesi absensi baru
            SesiAbsensi::create([
                'jadwal_id' => $jadwalId,
                'guru_id' => $user->id,
                'waktu_buka' => now(),
                'is_active' => true
            ]);

            $alreadyPresensi = Absensi::where('jadwal_id', $jadwalId)
                ->where('user_id', Auth::id())
                ->whereDate('created_at', now()->toDateString())
                ->exists();

            session(['sudah_presensi' => $alreadyPresensi]);
            session(['tidak_boleh_buka' => true]);

            session(['has_opened_attendance' => true]);
            return redirect()->route('absensi.siswa')->with('success', 'Sesi absensi berhasil dibuka');
        } catch (\Exception $e) {
            Log::error('Error saat membuka sesi absensi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuka sesi absensi. ' . $e->getMessage());
        }
    }

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

        return redirect()->route('dashboardGuru.index')->with('success', 'Sesi absen berhasil ditutup');
    }
}
