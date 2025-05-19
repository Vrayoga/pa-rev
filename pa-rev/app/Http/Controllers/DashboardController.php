<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Logbook;
use Illuminate\Http\Request;
 use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;
use App\Models\AbsensiEkstrakurikuler;

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

    $pendaftarans = Pendaftaran::with([
        'ekstrakurikuler.jadwals',
        'ekstrakurikuler.user', // Pembina
        'absensiEkstrakurikuler.sesiAbsen',
    ])
    ->where('users_id', $user->id)
    ->where('status_validasi', 'diterima')
    ->get();

    // Ambil jumlah hadir total
    $jumlahHadir = AbsensiEkstrakurikuler::where('user_id', $user->id)
        ->where('status', 'Hadir')
        ->count();

    $jumlahTotal = AbsensiEkstrakurikuler::where('user_id', $user->id)->count();
    $persenHadir = $jumlahTotal > 0 ? round(($jumlahHadir / $jumlahTotal) * 100) . '%' : '0%';

    $jumlahPrestasi = AbsensiEkstrakurikuler::where('user_id', $user->id)->count();
    $jumlahLogbook = Logbook::where('user_id', $user->id)->count();

    return view('users.siswaDashboard', compact(
        'pendaftarans',
        'jumlahHadir',
        'jumlahTotal',
        'persenHadir',
        'jumlahPrestasi',
        'jumlahLogbook'
    ));
}
}
