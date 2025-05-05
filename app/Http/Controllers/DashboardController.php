<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

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

}
