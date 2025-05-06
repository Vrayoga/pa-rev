<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SesiAbsensi;
use App\Models\JadwalEkstrakurikuler;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class TutupAbsensiOtomatis extends Command
{
    protected $signature = 'tutup:absensi-otomatis';
    protected $description = 'Menutup sesi absensi yang sudah melewati jam selesai';

    public function handle()
    {
        $sesiAktif = SesiAbsensi::where('is_active', true)->get();

        foreach ($sesiAktif as $sesi) {
            $jadwal = JadwalEkstrakurikuler::find($sesi->jadwal_id);

            if ($jadwal && $jadwal->jam_selesai) {
                $tanggalSesi = Carbon::parse($sesi->waktu_buka)->toDateString();
                $jamSelesai = Carbon::parse("{$tanggalSesi} {$jadwal->jam_selesai}");

                if (now()->greaterThanOrEqualTo($jamSelesai)) {
                    // Update sesi absensi menjadi tidak aktif
                    $sesi->update([
                        'waktu_tutup' => now(),
                        'is_active' => false
                    ]);


                    $user = $sesi->guru; // Ambil user yang membuka absensi
                    if ($user) {
                        session()->forget(['has_opened_attendance', 'absensi_data']);
                    }

                    // Log informasi
                    Log::info('Sesi absensi ditutup otomatis via command', [
                        'sesi_id' => $sesi->id,
                        'jadwal_id' => $jadwal->id,
                        'jam_selesai' => $jadwal->jam_selesai,
                    ]);
                }
            }
        }

        $this->info('Pengecekan selesai.');
    }
}
