<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\AbsensiEkstrakurikuler;
use Carbon\Carbon;
use App\Models\Pendaftaran;
use App\Models\SesiAbsensi;
use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\JadwalEkstrakurikuler;
use App\Models\SesiAbsensiEkstrakurikuler;

class AbsensiEkstrakurikulerController extends Controller
{

    
    // Menampilkan halaman absensi siswa
    public function absensiSiswa()
    {
        $user = Auth::user();

        if (!$user->hasRole('guru_pembina')) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses');
        }

        // Ambil sesi absensi aktif milik guru ini
        $sesiAktif = SesiAbsensiEkstrakurikuler::where('guru_pembina_id', $user->id)
            ->where('is_active', true)
            ->with(['jadwal.ekstrakurikuler'])
            ->first();

        if (!$sesiAktif) {
            return redirect()->route('dashboardGuru.index')->with('error', 'Tidak ada sesi absensi yang aktif');
        }

        // Ambil data anggota ekstrakurikuler (siswa yang terdaftar)
        $ekstrakurikulerId = $sesiAktif->jadwal->ekstrakurikuler->id;

        // Ambil siswa yang terdaftar di ekstrakurikuler ini (dari tabel pendaftaran)
        $anggota = Pendaftaran::where('ekstrakurikuler_id', $ekstrakurikulerId)
            ->where('status_validasi', 'diterima')
            ->with(['user', 'AbsensiEkstrakurikuler' => function ($query) use ($sesiAktif) {
                $query->where('sesi_absen_ekstrakurikuler_id', $sesiAktif->id);
            }])
            ->get();

        return view('halaman-admin.absensi.index', [
            'sesiAktif' => $sesiAktif,
            'anggota' => $anggota
        ]);
    }


    public function simpanAbsensi(Request $request)
    {

        $request->validate([
            'sesi_absen_ekstrakurikuler_id' => 'required|exists:sesi_absen_ekstrakurikuler,id',
            'status' => 'required|array',
            'status.*' => 'in:hadir,izin,sakit,alfa',
            'catatan' => 'nullable|array',
            'catatan.*' => 'nullable|string|max:255'
        ]);
    
        foreach ($request->status as $pendaftaranId => $status) {
            AbsensiEkstrakurikuler::updateOrCreate(
                [
                    'sesi_absen_ekstrakurikuler_id' => $request->sesi_absen_ekstrakurikuler_id,
                    'pendaftaran_id' => $pendaftaranId // This was missing
                ],
                [
                    'status' => $status,
                    'catatan' => $request->catatan[$pendaftaranId] ?? null,
                    // These timestamps will be automatically handled by Eloquent
                ]
            );
        }
    
        return redirect()->route('absensi.siswa')->with('success', 'Absensi berhasil disimpan');
    }

    public function selesaiSesi($id)
    {
        $sesi = SesiAbsensiEkstrakurikuler::findOrFail($id);
        $sesi->update(['is_active' => false]);

        return redirect()->route('dashboardGuru.index')->with('success', 'Sesi absensi telah diselesaikan');
    }
}
