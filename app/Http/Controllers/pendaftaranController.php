<?php
namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
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
                        $ekstra->sisa_kuota = $ekstra->stok - $pendaftarDiterima;
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
    
        // Ekstrakurikuler tersedia (stok masih ada, bukan wajib, dan belum ditolak)
        $ekstrakurikulers = Ekstrakurikuler::where(function($query) {
                $query->where('stok', '>', 0)
                      ->orWhereNull('stok');
            })
            ->where('jenis', '!=', 'wajib')
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
        
        if ($ekstrakurikuler->jenis != 'wajib' && $ekstrakurikuler->stok !== null) {
            $pendaftarDiterima = Pendaftaran::where('ekstrakurikuler_id', $ekstrakurikuler->id)
                ->where('status_validasi', 'diterima')
                ->count();
                
            if ($pendaftarDiterima >= $ekstrakurikuler->stok) {
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
    
        return redirect()->route('userSiswa.index')->with('success', 'Pendaftaran ekstrakurikuler berhasil diajukan. Harap tunggu validasi dari pembimbing.');
    }

    public function validasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak'
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        
        // Pastikan hanya guru pembimbing yang bisa validasi
        if (Auth::user()->hasRole('guru')) {
            $ekstraGuru = Auth::user()->ekstrakurikuler->pluck('id')->toArray();
            
            if (!in_array($pendaftaran->ekstrakurikuler_id, $ekstraGuru)) {
                return back()->with('error', 'Anda tidak berhak memvalidasi pendaftaran ini');
            }
        }

        $pendaftaran->update([
            'status_validasi' => $request->status,
            'validator_id' => Auth::id()
        ]);

        $status = $request->status == 'diterima' ? 'diterima' : 'ditolak';
        return back()->with('success', "Pendaftaran berhasil di$status");
    }


}