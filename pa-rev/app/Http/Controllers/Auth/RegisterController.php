<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    // Tampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

   public function getNamaSiswa(Request $request)
{
    $siswa = Siswa::where('nis_nip', $request->nis_nip)->first();

    if ($siswa) {
        return response()->json([
            'nama' => $siswa->nama_siswa,
            'email' => $siswa->email, // pastikan ada kolom email
        ]);
    }

    return response()->json([
        'nama' => null,
        'email' => null,
    ]);
}



    // Proses registrasi
public function register(Request $request)
{
    $request->validate([
        'nis_nip' => 'required|string|max:20',
        'email' => 'required|email|unique:users,email',
        'nama_siswa' => 'required|string|max:100',
    ]);

    // Cari siswa berdasarkan NIS
    $siswa = Siswa::where('nis_nip', $request->nis_nip)->first();

    if (!$siswa) {
        return redirect()->back()->withErrors(['nis_nip' => 'NIS tidak ditemukan.'])->withInput();
    }

    // Verifikasi nama siswa yang diinput sesuai dengan data di database
    if (strtolower($siswa->nama_siswa) !== strtolower($request->nama_siswa)) {
        return redirect()->back()->withErrors(['nama_siswa' => 'Nama siswa tidak sesuai dengan data NIS.'])->withInput();
    }

    // Cek apakah NIS sudah pernah digunakan di tabel users
    $userExists = User::where('nis_nip', $request->nis_nip)->exists();

    if ($userExists) {
        return redirect()->back()->withErrors(['nis_nip' => 'NIS sudah terdaftar. Silakan login.'])->withInput();
    }

    // Generate temporary password
    $tempPassword = Str::random(8);

    // Buat user baru
    $user = User::create([
        'name' => $siswa->nama_siswa,
        'email' => $request->email,
        'nis_nip' => $request->nis_nip,
        'password' => bcrypt($tempPassword),
        'email_verified_at' => now(), // Langsung set verified
    ]);

    // Assign role siswa
    $user->assignRole('siswa');

    // Login user
    Auth::login($user);
    
    // Set session flag for just registered user
    session(['just_registered' => true]);

    // Redirect ke halaman ubah password
    return redirect()->route('change.password')->with([
        'success' => 'Pendaftaran berhasil. Silakan ubah password Anda.',
    ]);
}
}
