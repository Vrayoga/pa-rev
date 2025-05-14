<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        // Ambil semua data kelas dan kirim ke view
        $kelas = Kelas::orderBy('id', 'desc')->get();
        return view('halaman-admin.kelas.index', compact('kelas'));
    }

    // public function show($id)
    // {
    //     $kelas = Kelas::find($id);
    //     if (!$kelas) {
    //         return redirect()->route('kelas.index')->with('error', 'Data kelas tidak ditemukan');
    //     }

    //     return view('halaman-admin.kelas', compact('kelas'));
    // }

    public function create()
    {
        // Get necessary data for dropdowns
        $jurusan = Jurusan::all(); // Assuming you have a Jurusan model
        
        // Tampilkan form untuk membuat data kelas baru
        return view('halaman-admin.kelas.create', compact('jurusan'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'tingkat' => 'required|in:X,XI,XII',
            'id_jurusan' => 'required|exists:jurusan,id',
            'kode_kelas' => 'required|max:100|unique:kelas,kode_kelas',
        ]);
    
        Kelas::create([
            'tingkat' => $request->tingkat,
            'id_jurusan' => $request->id_jurusan,
            'kode_kelas' => $request->kode_kelas,
            'id_users' => $request->id_users ?? null

        ]);
        
        return redirect('/kelas')->with('success', 'Kelas berhasil ditambahkan.');
    }

      public function edit($id)
    {
        $kelas = Kelas::with(['jurusan', 'siswa'])->find($id);
        
        if (!$kelas) {
            return redirect()->route('kelas.index')->with('error', 'Data kelas tidak ditemukan');
        }

        // Ambil data untuk dropdown
        $jurusan = Jurusan::all();


        return view('halaman-admin.kelas.edit', compact('kelas', 'jurusan'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'tingkat' => 'required|in:X,XI,XII',
            'id_jurusan' => 'required|exists:jurusan,id',
            'kode_kelas' => 'required|string|max:100',
            'id_users' => 'nullable|exists:users,id'
        ]);

        // Ambil data kelas
        $kelas = Kelas::find($id);

        if (!$kelas) {
            return redirect()->route('kelas.index')->with('error', 'Data kelas tidak ditemukan.');
        }

        // Update data
        $kelas->update([
            'tingkat' => $request->tingkat,
            'id_jurusan' => $request->id_jurusan,
            'kode_kelas' => $request->kode_kelas,
            'id_users' => $request->id_users
        ]);

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui.');
    }


    public function destroy($id)
    {


        $kelas = Kelas::find($id);
        if (!$kelas) {
            return redirect()->route('kelas.index')->with('error', 'Data kelas tidak ditemukan');
        }

        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus');
    }
}
