<?php

namespace App\Services;

use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Log;
use App\Models\AbsensiEkstrakurikuler;
use App\Models\SesiAbsensiEkstrakurikuler;

class AbsensiNotificationService
{
    protected $whatsAppService;

    public function __construct(WhatsAppService $whatsAppService)
    {
        $this->whatsAppService = $whatsAppService;
    }

    /**
     * Send attendance notifications to parents
     * 
     * @param int $sesiAbsenId Session ID
     * @param array $pendaftaranIds Array of registration IDs
     * @return void
     */
    public function sendAttendanceNotifications($sesiAbsenId, $pendaftaranIds)
    {
        $sesiAbsen = SesiAbsensiEkstrakurikuler::with('jadwal.ekstrakurikuler')->find($sesiAbsenId);
        $ekstrakurikulerName = $sesiAbsen->jadwal->ekstrakurikuler->nama_ekstrakurikuler ?? 'Ekstrakurikuler';


        if (!$sesiAbsen) {
            return;
        }

        $ekstrakurikulerName = $sesiAbsen->ekstrakurikuler->nama_ekstrakurikuler ?? 'Ekstrakurikuler';
        $tanggal = \Carbon\Carbon::parse($sesiAbsen->tanggal)->isoFormat('dddd, D MMMM Y');

        // Menambahkan delay berbeda untuk setiap pesan untuk menghindari deteksi spam
        $baseDelay = 8; // Minimal delay 8 menit

        foreach ($pendaftaranIds as $index => $pendaftaranId) {
            // Menghitung delay acak antara 8-12 menit (dalam detik)
            // Ditambah delay bertingkat berdasarkan index untuk mengirim pesan secara berurutan
            $randomMinutes = rand(0, 4); // Random 0-4 menit tambahan dari base 8 menit
            $delayInSeconds = ($baseDelay + $randomMinutes) * 60;

            // Menambahkan 30 detik delay antar pesan
            $sequentialDelay = $index * 30;
            $totalDelay = $delayInSeconds + $sequentialDelay;

            // Menjalankan pengiriman dengan delay
            dispatch(function () use ($pendaftaranId, $sesiAbsenId, $ekstrakurikulerName, $tanggal) {
                $this->sendSingleAttendanceNotification($pendaftaranId, $sesiAbsenId, $ekstrakurikulerName, $tanggal);
            })->delay(now()->addSeconds($totalDelay));
        }
    }

    /**
     * Send an attendance notification to a single parent
     * 
     * @param int $pendaftaranId Registration ID
     * @param int $sesiAbsenId Session ID
     * @param string $ekstrakurikulerName Name of the extracurricular activity
     * @param string $tanggal Formatted date
     * @return void
     */
    private function sendSingleAttendanceNotification($pendaftaranId, $sesiAbsenId, $ekstrakurikulerName, $tanggal)
    {
        $pendaftaran = Pendaftaran::with(['user', 'absensiEkstrakurikuler' => function ($query) use ($sesiAbsenId) {
            $query->where('sesi_absen_ekstrakurikuler_id', $sesiAbsenId);
        }])->find($pendaftaranId);

        if (!$pendaftaran || !$pendaftaran->nomer_wali) {
            return;
        }

        $studentName = $pendaftaran->user->name ?? $pendaftaran->nama_lengkap ?? 'Siswa';
        $absensi = $pendaftaran->absensiEkstrakurikuler->first();

        if (!$absensi) {
            Log::warning("Absensi tidak ditemukan untuk pendaftaran ID {$pendaftaranId} di sesi {$sesiAbsenId}");
            return;
        }
        $status = $this->formatStatus($absensi->status);
        $catatan = $absensi->catatan ? "\nCatatan: {$absensi->catatan}" : '';

        $message = "Yth. Bapak/Ibu Wali dari *{$studentName}*,\n\n";
        $message .= "Kami informasikan bahwa pada kegiatan *{$ekstrakurikulerName}* tanggal {$tanggal}, ";
        $message .= "putra/putri Bapak/Ibu tercatat *{$status}*{$catatan}.\n\n";
        $message .= "Terima kasih atas perhatian dan kerjasamanya.";

        $this->whatsAppService->sendMessage($pendaftaran->nomer_wali, $message);
    }

    /**
     * Format the attendance status into Indonesian
     * 
     * @param string $status Raw status
     * @return string Formatted status
     */
    private function formatStatus($status)
    {
        switch ($status) {
            case 'hadir':
                return 'HADIR';
            case 'izin':
                return 'IZIN';
            case 'sakit':
                return 'SAKIT';
            case 'alfa':
                return 'TIDAK HADIR (TANPA KETERANGAN)';
            default:
                return strtoupper($status);
        }
    }
}
