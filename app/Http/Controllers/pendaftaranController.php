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
    public function showAnggota()
    {
        $user = Auth::user();
        $pendaftarans = collect();
        $ekstrakurikulers = collect();
    
        if ($user->hasRole('guru')) {
            // Jika user adalah guru, ambil ekstrakurikuler yang dia bimbing
            $ekstrakurikulers = Ekstrakurikuler::where('id_users', $user->id)->get();
            
            if ($ekstrakurikulers->isNotEmpty()) {
                $ekstrakurikulerIds = $ekstrakurikulers->pluck('id');
                $pendaftarans = Pendaftaran::with(['kelas', 'ekstrakurikuler'])
                    ->whereIn('ekstrakurikuler_id', $ekstrakurikulerIds)
                    ->orderBy('created_at', 'desc')
                    ->get();
                
                // Hitung jumlah pendaftar untuk setiap ekstrakurikuler
                foreach ($ekstrakurikulers as $ekstra) {
                    $pendaftarDiterima = $pendaftarans->where('ekstrakurikuler_id', $ekstra->id)
                                                   ->where('status_validasi', 'diterima')
                                                   ->count();
                    
                    // Tambahkan properti untuk jumlah pendaftar
                    $ekstra->jumlah_pendaftar = $pendaftarDiterima;
                    
                    // Jika ekstrakurikuler wajib, sisa kuota adalah "tak terbatas"
                    // Jika pilihan, hitung sisa kuota normal
                    if ($ekstra->jenis == 'wajib') {
                        $ekstra->sisa_kuota = 'tak_terbatas';
                    } else {
                        $ekstra->sisa_kuota = $ekstra->kuota - $pendaftarDiterima;
                    }
                }
            }
        } else {
            // Jika admin atau role lain, tampilkan semua pendaftaran
            $pendaftarans = Pendaftaran::with(['kelas', 'ekstrakurikuler'])
                ->orderBy('created_at', 'desc')
                ->get();
                
            // Untuk admin, tampilkan semua ekstrakurikuler
            $ekstrakurikulers = Ekstrakurikuler::all();
            
            // Hitung jumlah pendaftar untuk setiap ekstrakurikuler
            foreach ($ekstrakurikulers as $ekstra) {
                $pendaftarDiterima = Pendaftaran::where('ekstrakurikuler_id', $ekstra->id)
                                               ->where('status_validasi', 'diterima')
                                               ->count();
                
                $ekstra->jumlah_pendaftar = $pendaftarDiterima;
                
                // Jika ekstrakurikuler wajib, sisa kuota adalah "tak terbatas"
                // Jika pilihan, hitung sisa kuota normal
                if ($ekstra->jenis == 'wajib') {
                    $ekstra->sisa_kuota = 'tak_terbatas';
                } else {
                    $ekstra->sisa_kuota = $ekstra->kuota - $pendaftarDiterima;
                }
            }
        }
    
        return view('halaman-admin.pendaftaran.index', [
            'pendaftarans' => $pendaftarans,
            'ekstrakurikulers' => $ekstrakurikulers 
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
    $ekstrakurikulers = Ekstrakurikuler::where(function($query) {
            // For non-required ekstrakurikuler, check quota
            $query->where(function($q) {
                $q->where('jenis', '!=', 'wajib')
                  ->where(function($q2) {
                      // Either has available quota or unlimited quota
                      $q2->where('kuota', '>', function($subQuery) {
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
        $request->validate([
            'ekstrakurikuler_id' => 'required|exists:ekstrakurikuler,id',
            'alasan' => 'required|string|max:255',
            'nomer_wali' => 'required|string|max:15'
        ]);
    
        $user = Auth::user();
        $siswa = $user->siswa;
    
        // Cek apakah user sudah memiliki pendaftaran yang masih pending
        $pendingRegistration = Pendaftaran::where('users_id', $user->id)
            ->where('status_validasi', 'pending')
            ->first();
        
        if ($pendingRegistration) {
            return back()->with('error', 'Anda memiliki pendaftaran yang sedang menunggu validasi. Harap tunggu hingga pendaftaran sebelumnya divalidasi.');
        }
    
        // Check if already registered for this extracurricular
        $existingRegistration = Pendaftaran::where('users_id', $user->id)
            ->where('ekstrakurikuler_id', $request->ekstrakurikuler_id)
            ->exists();
    
        if ($existingRegistration) {
            return back()->with('error', 'Anda sudah terdaftar di ekstrakurikuler ini');
        }
    
        // Check if extracurricular still has available slots
        $ekstrakurikuler = Ekstrakurikuler::find($request->ekstrakurikuler_id);
        
        if ($ekstrakurikuler->jenis != 'wajib' && $ekstrakurikuler->kuota !== null) {
            $pendaftarDiterima = Pendaftaran::where('ekstrakurikuler_id', $ekstrakurikuler->id)
                ->where('status_validasi', 'diterima')
                ->count();
                
            if ($pendaftarDiterima >= $ekstrakurikuler->kuota) {
                return back()->with('error', 'Kuota ekstrakurikuler ini sudah penuh');
            }
        }
    
        // Create new registration
        Pendaftaran::create([
            'users_id' => $user->id,
            'ekstrakurikuler_id' => $request->ekstrakurikuler_id,
            'kelas_id' => $siswa->id_kelas,
            'nama_lengkap' => $user->name,
            'no_telepon' => $siswa->no_telepon,
            'alasan' => $request->alasan,
            'nomer_wali' => $request->nomer_wali,
            'status_validasi' => 'pending' // Default status
        ]);


        $ekstra = Ekstrakurikuler::find($request->ekstrakurikuler_id);
    
    // Debugging
    Log::debug('Attempting to create notification', [
        'user_id' => $user->id,
        'receiver_id' => $ekstra->id_users,
        'ekstra' => $ekstra->toArray()
    ]);

    // Pastikan receiver ada dan punya role guru
    $guru = User::with('roles')->find($ekstra->id_users);
    
    if (!$guru) {
        Log::error('Guru not found for ekstra', ['id_users' => $ekstra->id_users]);
        return back()->with('error', 'Pembimbing tidak ditemukan');
    }

    if (!$guru->hasRole('guru')) {
        Log::error('Receiver is not a guru', ['user' => $guru->toArray()]);
        return back()->with('error', 'Pembimbing tidak valid');
    }
    
        NotifPendaftaran::create([
            'user_id' => $user->id,
            'receiver_id' => $ekstra->id_users,
            'title' => 'Pendaftaran Baru',
            'message' => 'Siswa ' . $user->name . ' mendaftar ke ekstrakurikuler ' . $ekstra->nama_ekstrakurikuler,
            'is_read' => false,
        ]);
    
    
        return redirect()->route('userSiswa.index')->with('success', 'Pendaftaran ekstrakurikuler berhasil diajukan. Harap tunggu validasi dari pembimbing.');
    }


    public function validasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak'
        ]);
    
        $pendaftaran = Pendaftaran::findOrFail($id);
        $user = Auth::user();
        
        // Pastikan hanya guru pembimbing yang bisa validasi
        if ($user->hasRole('guru')) {
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
        }
        elseif ($request->status == 'ditolak' && $pendaftaran->status_validasi == 'diterima') {
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