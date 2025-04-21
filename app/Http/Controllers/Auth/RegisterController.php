<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    // Tampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses registrasi
    public function register(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nis' => 'required|string|max:18',
            'email' => 'required|email|unique:users,email',
        ]);

        // Cari siswa berdasarkan NIS
        $siswa = Siswa::where('nis', $request->nis)->first();

        if (!$siswa) {
            return redirect()->back()->withErrors(['nis' => 'NIS tidak ditemukan.']);
        }

        // Cek apakah NIS sudah pernah digunakan di tabel users
        $userExists = User::where('nis', $request->nis)->exists();

        if ($userExists) {
            return redirect()->back()->withErrors(['nis' => 'NIS sudah digunakan.']);
        }

        // Input data ke tabel users
        $name = $siswa->nama_siswa;
        $email = $request->email;
        $nis = $request->nis;
        $password = Str::random(8); // Generate random password

        Siswa::where('nis', $nis)->update([
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
        ]);
        
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'nis' => $nis,

            'password' => bcrypt($password),
        ]);

       

        event(new Registered($user));

        Auth::login($user);

        return redirect('/email/verify')->with('success', 'Berhasil login sebagai siswa.');
    }
}
