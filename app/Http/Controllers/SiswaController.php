<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    // Tampilkan semua siswa
    public function index()
    {

        $siswa = DB::table('siswas')
            ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
            ->select(
                'siswas.*',
                'kelas.kelas as tingkat_kelas',  // Ambil kolom 'kelas' (X, XI, XII)
                'kelas.jurusan as nama_jurusan'  // Ambil kolom jurusan
            )
            ->get();

        return view('halaman-admin.siswa.index', compact('siswa'));
    }

    // Tampilkan form tambah siswa
    public function create()
    {
        $Kelas = Kelas::all();
        return view('halaman-admin.siswa.create', compact('Kelas'));
    }

    public function store(Request $request)
    {



        $pw =  Str::random(8);


        $data = [
            'nama_siswa' => $request->nama_siswa,
            'sekolah_asal' => $request->sekolah_asal,
            'alamat' => $request->alamat,
            'nis' => $request->nis,
            'id_kelas' => $request->id_kelas,
        ];

        $siswa =  Siswa::create($data);


        // User::create([
        //     'siswas_id' => $siswa->id,
        //     'nis' => $request->nis,
        //     'password' => bcrypt('SMK_' . $pw),
        //     'name' =>  $request->nama_siswa,
        //     // 'email' => Str::random(8) . '@gmail.com',
        // ]);

        return redirect('siswa');
    }





    // Tampilkan detail siswa
    public function show(Siswa $siswa)
    {
        return view('siswa.show', compact('siswa'));
    }

    // Form edit
    public function edit(Siswa $siswa)
    {

        $Kelas = Kelas::all();


        return view('halaman-admin.siswa.edit', compact('siswa', 'Kelas'));
    }

    // Update data siswa
    public function update(Request $request, Siswa $siswa)
    {
        // $request->validate([
        //     'nama_siswa' => 'required|string|max:255',
        //     'alamat' => 'required|string',
        //     'nis' => 'required|string|unique:siswas,nis,' . $siswa->id,
        // ]);
        
        $siswa->update($request->all());

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diupdate.');
    }

    // Hapus siswa
    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        if (!$siswa) {
            return redirect()->route('siswa.index')->with('error', 'Data kelas tidak ditemukan');
        }

        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data kelas berhasil dihapus');
    }
}
