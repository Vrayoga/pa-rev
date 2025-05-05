<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;
use Illuminate\Support\Facades\DB;
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
        } elseif ($user->hasRole('guru')) {
            return redirect()->intended('/guru'); // Route untuk guru
        } elseif ($user->hasRole('siswa')) {
            return redirect()->intended('/ekstraSiswa'); // Route untuk siswa
        } else {
            Auth::logout(); // kalau tidak punya role
            return redirect('/login')->withErrors(['email' => 'Role tidak dikenali.']);
        }
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->onlyInput('email');
}
    // public function login(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required'
    //     ]);

    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();
    //         return redirect()->intended('/dashboard');
    //     }

    //     return back()->withErrors([
    //         'email' => 'Email atau password salah.',
    //     ])->onlyInput('email');
    // }

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
        
        // Pakai Query Builder untuk siswa
        $siswa = DB::table('siswas')
            ->where('nis', $user->nis)
            ->first();
            
        // Ambil data kelas menggunakan Query Builder
        $kelas = null;
        if ($siswa) {
            $kelas = DB::table('kelas')
                ->where('id', $siswa->id_kelas)
                ->first();
        }
    
        // Pakai Eloquent untuk ekstrakurikuler
        $mandatoryEkstra = Ekstrakurikuler::where('jenis', 'wajib')->first();
    
        return view('auth.change-password', compact('mandatoryEkstra', 'siswa', 'kelas'));
    }



    public function changePasswordAndRegister(Request $request)
    {
        $request->validate([

            'password' => 'required|min:6|confirmed',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }
    
        // Update password
        $user->password = bcrypt($request->password);
        $user->save();
    
        // Dapatkan data siswa
        $siswa = Siswa::where('nis', $user->nis)->first();
    
        // Dapatkan ekstrakurikuler wajib
        $ekstraWajib = Ekstrakurikuler::where('jenis', 'wajib')->first();
    
        if ($ekstraWajib && $siswa) {
            // Cek apakah sudah terdaftar di ekstra ini
            $sudahDaftar = Pendaftaran::where('users_id', $user->id)
                            ->where('ekstrakurikuler_id', $ekstraWajib->id)
                            ->exists();
    
            if (!$sudahDaftar) {
                // Otomatis daftarkan ke ekstra wajib
                Pendaftaran::create([
                    'users_id' => $user->id,
                    'ekstrakurikuler_id' => $ekstraWajib->id,
                    'kelas_id' => $siswa->id_kelas,
                    'nama_lengkap' => $user->name,
                    'no_telepon' => $siswa->no_telepon,
                    'alasan' => 'Pendaftaran otomatis ekstrakurikuler wajib',
                    'nomer_wali' => $request->nomer_wali, 
                    'status_validasi' => 'diterima'
                ]);
            }
        }
    
        return response()->json([
            'redirect' => url('/ekstraSiswa'),
        ]);
        // return redirect('/ekstraSiswa')->with('success', 'Password berhasil diubah dan pendaftaran ekstrakurikuler wajib telah dilakukan.');
    }
}