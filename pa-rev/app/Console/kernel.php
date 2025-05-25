<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use App\Models\SesiAbsensi;
use App\Models\JadwalEkstrakurikuler;
use App\Models\SesiAbsensiEkstrakurikuler;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $sesiAktif = SesiAbsensiEkstrakurikuler::where('is_active', true)->get();

            foreach ($sesiAktif as $sesi) {
                $jadwal = JadwalEkstrakurikuler::find($sesi->jadwal_id);

                if ($jadwal && $jadwal->jam_selesai) {
                    $tanggalSesi = Carbon::parse($sesi->waktu_buka)->toDateString();
                    $jamSelesai = Carbon::parse("$tanggalSesi {$jadwal->jam_selesai}");

                    if (now()->greaterThanOrEqualTo($jamSelesai)) {
                        $sesi->update([
                            'waktu_tutup' => now(),
                            'is_active' => false
                        ]);

                        Log::info('Sesi absensi ditutup otomatis oleh scheduler', [
                            'sesi_id' => $sesi->id,
                            'guru_id' => $sesi->guru_id,
                            'jadwal_id' => $sesi->jadwal_id
                        ]);
                    }
                }
            }
        })->everyMinute();
    }
}
