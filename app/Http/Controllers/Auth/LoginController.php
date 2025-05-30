<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;
use App\Models\NotifPendaftaran;
use App\Events\NotificationEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->hasRole('admin')) {
                return redirect()->intended('/dashboard');
            } elseif ($user->hasRole('guru_pembina')) {
                return redirect()->intended('/guru-pembina'); // Route untuk guru
            } elseif ($user->hasRole('siswa')) {
                return redirect()->intended('/siswa-dashboard'); // Route untuk siswa
            } else {
                Auth::logout(); // kalau tidak punya role
                return redirect('/login')->withErrors(['email' => 'Role tidak dikenali.']);
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }


    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }


    public function showChangePasswordForm()
    {

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $siswa = Siswa::where('nis_nip', $user->nis_nip)->first();

        if (!$siswa) {
            return redirect()->route('login')->with('error', 'Data siswa tidak ditemukan.');
        }

        // Ambil kelas aktif dari relasi pivot kelas_siswa
        $kelas = $siswa->kelasAktif?->kelas?->load('jurusan');


        $mandatoryEkstra = Ekstrakurikuler::where('jenis', 'wajib')->first();
        $ekstrakurikulerPilihan = Ekstrakurikuler::where('jenis', 'pilihan')->get();

        // Clear the just_registered flag after showing the form
        session()->forget('just_registered');

        return view('auth.change-password', compact('siswa', 'kelas', 'mandatoryEkstra', 'ekstrakurikulerPilihan'));
    }


    private function formatPhoneNumber($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (substr($phone, 0, 1) == '0') {
            $phone = '62' . substr($phone, 1);
        } elseif (substr($phone, 0, 1) == '8') {
            $phone = '62' . $phone;
        }

        return $phone;
    }


   public function changePasswordAndRegister(Request $request)
{
    $request->merge([
        'nomer_wali' => $this->formatPhoneNumber($request->nomer_wali)
    ]);

    // Validasi input
    $request->validate([
        'password' => 'required|min:6|confirmed',
        'nomer_wali' => ['required', 'regex:/^62[0-9]{9,13}$/'],
        'ekstrakurikuler_pilihan_id' => 'nullable|array', // opsional, bisa kosong
        'ekstrakurikuler_pilihan_id.*' => 'exists:ekstrakurikuler,id', // pastikan ID valid
    ]);

    $user = Auth::user();
    if (!$user) {
        return response()->json(['status' => 'error', 'message' => 'User tidak ditemukan.'], 404);
    }

    // Update password
    $user->password = bcrypt($request->password);
    $user->save();

    $siswa = Siswa::where('nis_nip', $user->nis_nip)->first();

    // ====== Ekstrakurikuler Wajib ======
    $ekstraWajib = Ekstrakurikuler::where('jenis', 'wajib')->first();
    if ($ekstraWajib && $siswa) {
        $sudahDaftar = Pendaftaran::where('users_id', $user->id)
            ->where('ekstrakurikuler_id', $ekstraWajib->id)
            ->exists();

        if (!$sudahDaftar) {
            Pendaftaran::create([
                'users_id' => $user->id,
                'ekstrakurikuler_id' => $ekstraWajib->id,
                'kelas_siswa_id' => $siswa->kelasAktif?->id,
                'nama_lengkap' => $user->name,
                'no_telepon' => $siswa->no_telepon,
                'alasan' => 'Pendaftaran otomatis ekstrakurikuler wajib',
                'nomer_wali' => $request->nomer_wali,
                'status_validasi' => 'diterima'
            ]);

            // Mendapatkan guru pembina ekstrakurikuler wajib
            $guruWajib = User::where('id', $ekstraWajib->id_users)
                             ->whereHas('roles', function($query) {
                                 $query->where('name', 'guru_pembina');
                             })
                             ->first();

            if ($guruWajib) {
                NotifPendaftaran::create([
                    'user_id' => $user->id,
                    'receiver_id' => $guruWajib->id,  // Menggunakan ID guru pembina yang sudah ditemukan
                    'title' => 'Pendaftaran Baru',
                    'message' =>  $user->name . ' mendaftar ke ekstrakurikuler wajib ' . $ekstraWajib->nama_ekstrakurikuler,
                    'is_read' => false,
                ]);

                // Memicu event untuk mengirimkan notifikasi
                event(new NotificationEvent($guruWajib->id, 'Pendaftaran Baru', 'Siswa ' . $user->name . ' mendaftar ke ekstrakurikuler wajib ' . $ekstraWajib->nama_ekstrakurikuler));
            }
        }
    }

    // ====== Ekstrakurikuler Pilihan ======
    if ($request->has('ekstrakurikuler_pilihan_id')) {
        $jumlahPilihan = is_array($request->ekstrakurikuler_pilihan_id) ? count($request->ekstrakurikuler_pilihan_id) : 0;
        $nomerWali = $request->nomer_wali;

        if ($jumlahPilihan > 2) {
            return response()->json(['status' => 'error', 'message' => 'Maksimal hanya boleh memilih 2 ekstrakurikuler pilihan.'], 422);
        }

        foreach ($request->ekstrakurikuler_pilihan_id as $ekstraId) {
            $sudahDaftarPilihan = Pendaftaran::where('users_id', $user->id)
                ->where('ekstrakurikuler_id', $ekstraId)
                ->exists();

            if (!$sudahDaftarPilihan) {
                $ekstra = Ekstrakurikuler::find($ekstraId);

                if ($ekstra->jenis != 'wajib' && $ekstra->kuota !== null) {
                    $pendaftarDiterima = Pendaftaran::where('ekstrakurikuler_id', $ekstra->id)
                        ->where('status_validasi', 'diterima')
                        ->count();

                    if ($pendaftarDiterima >= $ekstra->kuota) {
                        continue;
                    }
                }

                Pendaftaran::create([
                    'users_id' => $user->id,
                    'ekstrakurikuler_id' => $ekstraId,
                    'kelas_siswa_id' => $siswa->kelasAktif->id ?? null,
                    'nama_lengkap' => $user->name,
                    'no_telepon' => $siswa->no_telepon,
                    'alasan' => $request->alasan_pilihan[$ekstraId] ?? 'Tidak ada alasan khusus',
                    'nomer_wali' => $nomerWali,
                    'status_validasi' => 'pending'
                ]);

                // Kirim notifikasi untuk ekstrakurikuler pilihan
                if ($ekstra) {
                    $guru = User::where('id', $ekstra->id_users)
                                ->whereHas('roles', function($query) {
                                    $query->where('name', 'guru_pembina');
                                })
                                ->first();

                    if ($guru) {
                        NotifPendaftaran::create([
                            'user_id' => $user->id,
                            'receiver_id' => $guru->id,
                            'title' => 'Pendaftaran Baru',
                            'message' => $user->name . ' mendaftar ke ekstrakurikuler ' . $ekstra->nama_ekstrakurikuler,
                            'is_read' => false,
                        ]);

                        // Memicu event untuk mengirimkan notifikasi
                        event(new NotificationEvent($guru->id, 'Pendaftaran Baru', 'Siswa ' . $user->name . ' mendaftar ke ekstrakurikuler ' . $ekstra->nama_ekstrakurikuler));
                    }
                }
            }
        }
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Password berhasil diubah dan pendaftaran ekstrakurikuler diproses.',
        'redirect' => url('/siswa-dashboard'),
    ]);
}
}
