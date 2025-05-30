<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;
use App\Models\notifPendaftaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    public function showAnggota(Request $request)
    {
        $user = Auth::user();
        $pendaftarans = collect();
        $ekstrakurikulers = collect();

        // Ambil parameter filter dari request
        $filter = $request->input('filter', 'all');

        if ($user->hasRole('guru_pembina')) {
            $ekstrakurikulers = Ekstrakurikuler::where('id_users', $user->id)->get();

            if ($ekstrakurikulers->isNotEmpty()) {
                $ekstrakurikulerIds = $ekstrakurikulers->pluck('id');
                $query = Pendaftaran::with(['kelas', 'ekstrakurikuler'])
                    ->whereIn('ekstrakurikuler_id', $ekstrakurikulerIds);

                // Selalu exclude yang diterima kecuali filter khusus
                if ($filter === 'diterima') {
                    $query->where('status_validasi', 'diterima');
                } else {
                    $query->where('status_validasi', '!=', 'diterima');

                    if ($filter != 'all') {
                        $query->where('status_validasi', $filter);
                    }
                }

                $pendaftarans = $query->orderBy('created_at', 'desc')->get();

                foreach ($ekstrakurikulers as $ekstra) {
                    $pendaftarDiterima = Pendaftaran::where('ekstrakurikuler_id', $ekstra->id)
                        ->where('status_validasi', 'diterima')
                        ->count();
                    $ekstra->jumlah_pendaftar = $pendaftarDiterima;
                    $ekstra->sisa_kuota = ($ekstra->jenis == 'wajib') ? 'tak_terbatas' : ($ekstra->kuota - $pendaftarDiterima);
                }
            }
        } else {
            $query = Pendaftaran::with(['kelas', 'ekstrakurikuler']);

            // Selalu exclude yang diterima kecuali filter khusus
            if ($filter === 'diterima') {
                $query->where('status_validasi', 'diterima');
            } else {
                $query->where('status_validasi', '!=', 'diterima');

                if ($filter != 'all') {
                    $query->where('status_validasi', $filter);
                }
            }

            $pendaftarans = $query->orderBy('created_at', 'desc')->get();
            $ekstrakurikulers = Ekstrakurikuler::all();

            foreach ($ekstrakurikulers as $ekstra) {
                $pendaftarDiterima = Pendaftaran::where('ekstrakurikuler_id', $ekstra->id)
                    ->where('status_validasi', 'diterima')
                    ->count();
                $ekstra->jumlah_pendaftar = $pendaftarDiterima;
                $ekstra->sisa_kuota = ($ekstra->jenis == 'wajib') ? 'tak_terbatas' : ($ekstra->kuota - $pendaftarDiterima);
            }
        }

        return view('halaman-admin.pendaftaran.index', [
            'pendaftarans' => $pendaftarans,
            'ekstrakurikulers' => $ekstrakurikulers,
            'currentFilter' => $filter
        ]);
    }

    public function daftarEkstra()
    {
        $user = Auth::user();

        // Ambil ekstrakurikuler yang pernah ditolak
        $rejectedEkstraIds = Pendaftaran::where('users_id', $user->id)
            ->where('status_validasi', 'ditolak')
            ->pluck('ekstrakurikuler_id')
            ->toArray();

        // Ekstrakurikuler tersedia
        $ekstrakurikulers = Ekstrakurikuler::where(function ($query) {
            // For non-required ekstrakurikuler, check quota
            $query->where(function ($q) {
                $q->where('jenis', '!=', 'wajib')
                    ->where(function ($q2) {
                        // Either has available quota or unlimited quota
                        $q2->where('kuota', '>', function ($subQuery) {
                            // Subquery to count accepted registrations
                            $subQuery->select(DB::raw('COUNT(*)'))
                                ->from('pendaftaran')
                                ->where('status_validasi', 'diterima')
                                ->whereColumn('ekstrakurikuler_id', 'ekstrakurikuler.id');
                        })
                            ->orWhereNull('kuota');
                    });
            })
                // Or it's required (wajib)
                ->orWhere('jenis', 'wajib');
        })
            ->whereNotIn('id', $rejectedEkstraIds)
            ->get();

        // Ekstrakurikuler yang masih pending
        $pendingRegistrations = Pendaftaran::where('users_id', $user->id)
            ->where('status_validasi', 'pending')
            ->with('ekstrakurikuler')
            ->get();

        // Ekstrakurikuler yang sudah diterima
        $registeredEkstras = Pendaftaran::where('users_id', $user->id)
            ->where('status_validasi', 'diterima')
            ->pluck('ekstrakurikuler_id')
            ->toArray();

        return view('users.ekstraRegis', compact('ekstrakurikulers', 'registeredEkstras', 'pendingRegistrations'));
    }


    public function storeRegisEkstra(Request $request)
    {
        $request->merge([
            'nomer_wali' => $this->formatPhoneNumber($request->nomer_wali)
        ]);

        // Validasi input
        $request->validate([
            'ekstrakurikuler_id_1' => 'nullable|exists:ekstrakurikuler,id',
            'alasan_1' => 'nullable|string|max:255',
            'ekstrakurikuler_id_2' => 'nullable|different:ekstrakurikuler_id_1|exists:ekstrakurikuler,id',
            'alasan_2' => 'nullable|string|max:255',
            'nomer_wali' => ['required', 'regex:/^62[0-9]{9,13}$/'],
        ]);

        $user = Auth::user();
        $siswa = $user->siswa;

        // Ambil semua pendaftaran pilihan yang sudah ada (pending dan diterima)
        $existingPilihanCount = Pendaftaran::where('users_id', $user->id)
            ->whereIn('status_validasi', ['pending', 'diterima'])
            ->whereHas('ekstrakurikuler', function ($query) {
                $query->where('jenis', '!=', 'wajib');
            })
            ->count();

        // Hitung ekstra pilihan yang akan didaftarkan
        $pilihanToRegister = 0;
        if ($request->ekstrakurikuler_id_1) $pilihanToRegister++;
        if ($request->ekstrakurikuler_id_2) $pilihanToRegister++;

        // Validasi jumlah pilihan (maksimal 2)
        if (($existingPilihanCount + $pilihanToRegister) > 2) {
            return back()->with('error', 'Anda hanya dapat memilih maksimal 2 ekstrakurikuler pilihan.');
        }

        $successCount = 0;
        $errorMessages = [];

        // Proses pendaftaran jika ada ekstra 1
        if ($request->ekstrakurikuler_id_1) {
            $ekstra1 = Ekstrakurikuler::find($request->ekstrakurikuler_id_1);

            // Pastikan yang didaftarkan adalah ekstra pilihan
            if ($ekstra1->jenis == 'wajib') {
                $errorMessages[] = "Ekstrakurikuler {$ekstra1->nama_ekstrakurikuler} adalah wajib dan sudah didaftarkan saat registrasi.";
            } else {
                $registrationSuccess = $this->processRegistration(
                    $user,
                    $siswa,
                    $request->ekstrakurikuler_id_1,
                    $request->alasan_1 ?: 'Tidak ada alasan yang diberikan',
                    $request->nomer_wali,
                    $errorMessages
                );

                if ($registrationSuccess) {
                    $successCount++;
                }
            }
        }

        // Proses pendaftaran jika ada ekstra 2
        if ($request->ekstrakurikuler_id_2) {
            $ekstra2 = Ekstrakurikuler::find($request->ekstrakurikuler_id_2);

            // Pastikan yang didaftarkan adalah ekstra pilihan
            if ($ekstra2->jenis == 'wajib') {
                $errorMessages[] = "Ekstrakurikuler {$ekstra2->nama_ekstrakurikuler} adalah wajib dan sudah didaftarkan saat registrasi.";
            } else {
                $registrationSuccess = $this->processRegistration(
                    $user,
                    $siswa,
                    $request->ekstrakurikuler_id_2,
                    $request->alasan_2 ?: 'Tidak ada alasan yang diberikan',
                    $request->nomer_wali,
                    $errorMessages
                );

                if ($registrationSuccess) {
                    $successCount++;
                }
            }
        }

        if ($successCount > 0) {
            $message = "Pendaftaran ekstrakurikuler pilihan berhasil diajukan untuk $successCount pilihan. Harap tunggu validasi dari pembimbing.";

            if (!empty($errorMessages)) {
                $errorMsg = implode(' ', $errorMessages);
                return redirect()->route('siswa.dashboard')->with('success', $message)->with('warning', $errorMsg);
            }

            return redirect()->route('siswa.dashboard')->with('success', $message);
        } else {
            $errorMsg = implode(' ', $errorMessages) ?: 'Tidak ada ekstrakurikuler pilihan yang dipilih untuk didaftarkan.';
            return back()->with('error', 'Pendaftaran gagal: ' . $errorMsg);
        }
    }
    /**
     * Proses pendaftaran untuk satu ekstrakurikuler
     * 
     * @param User $user
     * @param Siswa $siswa
     * @param int $ekstrakurikulerId
     * @param string $alasan
     * @param string $nomerWali
     * @param array &$errorMessages
     * @return bool
     */
    private function processRegistration($user, $siswa, $ekstrakurikulerId, $alasan, $nomerWali, &$errorMessages)
    {
        $nomerWali = $this->formatPhoneNumber($nomerWali);
        // Check if already registered for this extracurricular
        $existingRegistration = Pendaftaran::where('users_id', $user->id)
            ->where('ekstrakurikuler_id', $ekstrakurikulerId)
            ->exists();

        if ($existingRegistration) {
            $ekstra = Ekstrakurikuler::find($ekstrakurikulerId);
            $errorMessages[] = "Anda sudah terdaftar di ekstrakurikuler {$ekstra->nama_ekstrakurikuler}.";
            return false;
        }

        // Check if extracurricular still has available slots
        $ekstrakurikuler = Ekstrakurikuler::find($ekstrakurikulerId);

        if ($ekstrakurikuler->jenis != 'wajib' && $ekstrakurikuler->kuota !== null) {
            $pendaftarDiterima = Pendaftaran::where('ekstrakurikuler_id', $ekstrakurikuler->id)
                ->where('status_validasi', 'diterima')
                ->count();

            if ($pendaftarDiterima >= $ekstrakurikuler->kuota) {
                $errorMessages[] = "Kuota ekstrakurikuler {$ekstrakurikuler->nama_ekstrakurikuler} sudah penuh.";
                return false;
            }
        }

        // Create new registration
        Pendaftaran::create([
            'users_id' => $user->id,
            'ekstrakurikuler_id' => $ekstrakurikulerId,
            'kelas_siswa_id' => $siswa->kelasAktif?->id,
            'nama_lengkap' => $user->name,
            'no_telepon' => $siswa->no_telepon,
            'alasan' => $alasan,
            'nomer_wali' => $nomerWali,
            'status_validasi' => 'pending' // Default status
        ]);

        // Create notification
        try {
            // Pastikan receiver ada dan punya role guru
            $guru = User::with('roles')->find($ekstrakurikuler->id_users);

            if (!$guru) {
                Log::error('Guru not found for ekstra', ['id_users' => $ekstrakurikuler->id_users]);
                $errorMessages[] = "Pembimbing tidak ditemukan untuk {$ekstrakurikuler->nama_ekstrakurikuler}.";
                // Tetap return true karena pendaftaran tetap berhasil dibuat
            } else if (!$guru->hasRole('guru_pembina')) {
                Log::error('Receiver is not a guru', ['user' => $guru->toArray()]);
                $errorMessages[] = "Pembimbing tidak valid untuk {$ekstrakurikuler->nama_ekstrakurikuler}.";
                // Tetap return true karena pendaftaran tetap berhasil dibuat
            } else {
                NotifPendaftaran::create([
                    'user_id' => $user->id,
                    'receiver_id' => $ekstrakurikuler->id_users,
                    'title' => 'Pendaftaran Baru',
                    'message' => 'Siswa ' . $user->name . ' mendaftar ke ekstrakurikuler ' . $ekstrakurikuler->nama_ekstrakurikuler,
                    'is_read' => false,
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error creating notification', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            // Tetap return true karena pendaftaran tetap berhasil dibuat
        }

        return true;
    }

    /**
     * Mengubah format nomor telepon ke standar internasional (62)
     * Contoh: 0812345678 -> 62812345678
     */
    private function formatPhoneNumber($phone)
    {
        // Hapus semua karakter non-digit
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Jika diawali 0, ganti dengan 62
        if (substr($phone, 0, 1) == '0') {
            $phone = '62' . substr($phone, 1);
        }
        // Jika diawali 8 (tanpa 0), tambahkan 62
        elseif (substr($phone, 0, 1) == '8') {
            $phone = '62' . $phone;
        }
        // Jika sudah diawali 62, biarkan
        // Jika format tidak dikenal (misal +62), kembalikan as-is

        return $phone;
    }

    public function validasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak'
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $user = Auth::user();

        // Pastikan hanya guru pembimbing yang bisa validasi
        if ($user->hasRole('guru_pembina')) {
            $ekstraGuru = $user->ekstrakurikuler->pluck('id')->toArray();

            if (!in_array($pendaftaran->ekstrakurikuler_id, $ekstraGuru)) {
                return back()->with('error', 'Anda tidak berhak memvalidasi pendaftaran ini');
            }
        }

        // Proses validasi seperti sebelumnya
        if ($request->status == 'diterima' && $pendaftaran->status_validasi != 'diterima') {
            $ekstra = Ekstrakurikuler::find($pendaftaran->ekstrakurikuler_id);

            if ($ekstra->kuota > 0) {
                $ekstra->decrement('kuota');
            } else {
                return back()->with('error', 'Kuota sudah habis, tidak bisa menerima pendaftaran');
            }
        } elseif ($request->status == 'ditolak' && $pendaftaran->status_validasi == 'diterima') {
            Ekstrakurikuler::find($pendaftaran->ekstrakurikuler_id)->increment('kuota');
        }

        $pendaftaran->update([
            'status_validasi' => $request->status,
            'validator_id' => $user->id
        ]);

        $status = $request->status == 'diterima' ? 'diterima' : 'ditolak';

        // Redirect ke halaman anggota ekstra dengan pengecekan role
        if ($request->status == 'diterima') {
            return redirect()->route('anggota.ekstra', ['id' => $pendaftaran->ekstrakurikuler_id])
                ->with('success', "Pendaftaran berhasil di$status");
        }

        return back()->with('success', "Pendaftaran berhasil di$status");
    }

    
}
