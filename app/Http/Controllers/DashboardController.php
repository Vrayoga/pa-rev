<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $total_siswa = Siswa::count();
        return view('halaman-admin.index');
    }
}
