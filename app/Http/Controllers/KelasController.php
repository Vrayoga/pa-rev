<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        // Ambil semua data kelas dan kirim ke view
        $kelas = Kelas::all();
        return view('halaman-admin.kelas.index', compact('kelas'));
    }

    public function show($id)
    {
        $kelas = Kelas::find($id);
        if (!$kelas) {
            return redirect()->route('kelas.index')->with('error', 'Data kelas tidak ditemukan');
        }

        return view('halaman-admin.kelas', compact('kelas'));
    }

    public function create()
    {
        // Tampilkan form untuk membuat data kelas baru
        return view('halaman-admin.kelas.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        //     'kelas' => 'required|max:100',
        //     'jurusan' => 'required|max:100',
        // ]);

        Kelas::create($request->all());
        return redirect('kelas')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kelas = Kelas::find($id);
        if (!$kelas) {
            return redirect()->route('kelas.index')->with('error', 'Data kelas tidak ditemukan');
        }

        return view('halaman-admin.kelas.edit', compact('kelas'));
    }

    public function update(Request $request, $id)
{
    // Validasi langsung di dalam fungsi
    $request->validate([
        'kelas' => 'required|in:X,XI,XII',
        'jurusan' => 'required|string|max:100'
    ]);

    // Ambil data kelas
    $kelas = Kelas::find($id);

    if (!$kelas) {
        return redirect()->route('kelas.index')->with('error', 'Data kelas tidak ditemukan.');
    }

    // Update langsung dengan $request->all()
    $kelas->update($request->all());

    return redirect('/kelas')->with('success', 'Data kelas berhasil diperbarui.');
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
