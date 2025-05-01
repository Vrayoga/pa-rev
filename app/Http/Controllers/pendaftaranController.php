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

        if ($user->hasRole('guru')) {
            // Jika user adalah guru, ambil ekstrakurikuler yang dia bimbing
            $ekstrakurikuler = Ekstrakurikuler::where('id_users', $user->id)->pluck('id');
            
            if ($ekstrakurikuler->isNotEmpty()) {
                $pendaftarans = Pendaftaran::with(['kelas', 'ekstrakurikuler'])
                    ->whereIn('ekstrakurikuler_id', $ekstrakurikuler)
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
        } else {
            // Jika admin atau role lain, tampilkan semua pendaftaran
            $pendaftarans = Pendaftaran::with(['kelas', 'ekstrakurikuler'])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('halaman-admin.pendaftaran.index', [
            'pendaftarans' => $pendaftarans
        ]);

    }

    public function daftarEkstra()
    {
        // Get available extracurriculars (where stock > 0 or unlimited and type is not 'wajib')
        $ekstrakurikulers = Ekstrakurikuler::where(function($query) {
            $query->where('stok', '>', 0)
                  ->orWhereNull('stok');
        })->where('jenis', '!=', 'wajib')->get();

        return view('users.ekstraRegis', compact('ekstrakurikulers'));
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

        // Check if already registered for this extracurricular
        $existingRegistration = Pendaftaran::where('users_id', $user->id)
            ->where('ekstrakurikuler_id', $request->ekstrakurikuler_id)
            ->exists();

        if ($existingRegistration) {
            return back()->with('error', 'Anda sudah terdaftar di ekstrakurikuler ini');
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

        return redirect('/ekstraSiswa')
            ->with('success', 'Pendaftaran ekstrakurikuler berhasil diajukan');
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