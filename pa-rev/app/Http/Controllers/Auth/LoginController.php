<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;
use App\Models\NotifPendaftaran;
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


        Log::debug('Request Data', $request->all());
        $request->validate([
            'password' => 'required|min:6|confirmed',
            'nomer_wali' => ['required', 'regex:/^62[0-9]{9,13}$/'],
            'ekstrakurikuler_pilihan_id' => 'nullable|array', // opsional, bisa kosong
            'ekstrakurikuler_pilihan_id.*' => 'exists:ekstrakurikuler,id', // pastikan ID valid
        ]);

        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User tidak ditemukan.'
            ], 404);
        }

        // Update password
        $user->password = bcrypt($request->password);
        $user->save();

        // Dapatkan data siswa
        $siswa = Siswa::where('nis_nip', $user->nis_nip)->first();
        Log::debug('Siswa?', ['siswa' => $siswa]);

        // ====== EKSTRA WAJIB ======
        $ekstraWajib = Ekstrakurikuler::where('jenis', 'wajib')->first();
        Log::debug('Ekstra Wajib?', ['ekstraWajib' => $ekstraWajib]);

        if ($ekstraWajib && $siswa) {
            $sudahDaftar = Pendaftaran::where('users_id', $user->id)
                ->where('ekstrakurikuler_id', $ekstraWajib->id)
                ->exists();
                Log::debug('Sudah daftar wajib?', ['sudahDaftar' => $sudahDaftar]);

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
                

                // Kirim notifikasi untuk ekstrakurikuler wajib
                $guruWajib = User::find($ekstraWajib->id_users);
                if ($guruWajib && $guruWajib->hasRole('guru')) {
                    NotifPendaftaran::create([
                        'user_id' => $user->id,
                        'receiver_id' => $ekstraWajib->id_users,
                        'title' => 'Pendaftaran Baru',
                        'message' => 'Siswa ' . $user->name . ' mendaftar ke ekstrakurikuler wajib ' . $ekstraWajib->nama_ekstrakurikuler,
                        'is_read' => false,
                    ]);

                    Log::debug('Notification created for mandatory extracurricular', [
                        'user_id' => $user->id,
                        'receiver_id' => $ekstraWajib->id_users,
                        'ekstra' => $ekstraWajib->nama_ekstrakurikuler
                    ]);
                }
            }
        }

        // ====== EKSTRA PILIHAN ======
        if ($request->has('ekstrakurikuler_pilihan_id')) {
            // Hitung jumlah pilihan yang dikirim
            $jumlahPilihan = is_array($request->ekstrakurikuler_pilihan_id) ? count($request->ekstrakurikuler_pilihan_id) : 0;
            $nomerWali = $request->nomer_wali;

            if ($jumlahPilihan > 2) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Maksimal hanya boleh memilih 2 ekstrakurikuler pilihan.'
                ], 422);
            }

            foreach ($request->ekstrakurikuler_pilihan_id as $ekstraId) {
                // Cek apakah sudah terdaftar
                $sudahDaftarPilihan = Pendaftaran::where('users_id', $user->id)
                    ->where('ekstrakurikuler_id', $ekstraId)
                    ->exists();

                if (!$sudahDaftarPilihan) {
                    // Dapatkan data ekstrakurikuler
                    $ekstra = Ekstrakurikuler::find($ekstraId);

                    // Check if extracurricular still has available slots
                    if ($ekstra->jenis != 'wajib' && $ekstra->kuota !== null) {
                        $pendaftarDiterima = Pendaftaran::where('ekstrakurikuler_id', $ekstra->id)
                            ->where('status_validasi', 'diterima')
                            ->count();

                        if ($pendaftarDiterima >= $ekstra->kuota) {
                            continue; // Skip this extracurricular as it's full
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
                        // Debugging
                        Log::debug('Attempting to create notification', [
                            'user_id' => $user->id,
                            'receiver_id' => $ekstra->id_users,
                            'ekstra' => $ekstra->toArray()
                        ]);

                        // Pastikan receiver ada dan punya role guru
                        $guru = User::with('roles')->find($ekstra->id_users);

                        if ($guru && $guru->hasRole('guru_pembina')) {
                            NotifPendaftaran::create([
                                'user_id' => $user->id,
                                'receiver_id' => $ekstra->id_users,
                                'title' => 'Pendaftaran Baru',
                                'message' => 'Siswa ' . $user->name . ' mendaftar ke ekstrakurikuler ' . $ekstra->nama_ekstrakurikuler,
                                'is_read' => false,
                            ]);

                            Log::debug('Notification created for optional extracurricular', [
                                'user_id' => $user->id,
                                'receiver_id' => $ekstra->id_users,
                                'ekstra' => $ekstra->nama_ekstrakurikuler
                            ]);
                        } else {
                            Log::error('Notification not created - Receiver is not a guru or not found', [
                                'ekstra_id' => $ekstraId,
                                'id_users' => $ekstra->id_users
                            ]);
                        }
                    }
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Password berhasil diubah dan pendaftaran ekstrakurikuler diproses.',
            'redirect' => url('/siswa'),
        ]);
    }
}
