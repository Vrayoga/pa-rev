<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
 use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $total_siswa = Siswa::count();
        $total_kelas = Kelas::count();
        return view('halaman-admin.index', compact('total_siswa', 'total_kelas'));
    }


    // public function dashboardGuruEkstrakurikuler(){
    //     $total_siswa = Siswa::count();
    //     $total_kelas = Kelas::count();
    //     return view('halaman-admin.Guru', compact('total_siswa', 'total_kelas'));
    // }



public function siswaIndex()
{
    $user = Auth::user();

    // Ambil pendaftaran siswa yang diterima
    $pendaftarans = Pendaftaran::with([
        'ekstrakurikuler.jadwals',
        'ekstrakurikuler.user', // Pembina
        'absensiEkstrakurikuler.sesiAbsenEkstrakurikuler',
    ])
    ->where('users_id', $user->id)
    ->where('status_validasi', 'diterima')
    ->get();

    return view('users.siswaDashboard', compact('pendaftarans'));
}

}
