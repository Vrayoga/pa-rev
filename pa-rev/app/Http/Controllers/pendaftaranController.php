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

        if ($user->hasRole('guru')) {
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
