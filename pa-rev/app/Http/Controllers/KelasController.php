<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\KelasSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('jurusan')->get();
        $siswa = Siswa::whereNotIn('id', function ($query) {
            $query->select('id_siswa')->from('kelas_siswa');
        })->get();

        return view('halaman-admin.kelas.index', compact('kelas', 'siswa'));
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


    public function showSiswa($id)
    {
        $kelas = Kelas::with(['siswa', 'jurusan'])->findOrFail($id);

        // Ambil siswa yang TIDAK ada di tabel kelas_siswa sama sekali
        $siswa = Siswa::whereNotIn('id', function ($query) {
            $query->select('id_siswa')->from('kelas_siswa');
        })->get();

        return view('halaman-admin.kelas.siswa', compact('kelas', 'siswa'));
    }

    public function storeSiswa(Request $request, $kelasId)
    {
        $request->validate([
            'status' => 'required|in:new,naik,tidak_naik,lulus',
            'siswa_id' => 'required|array',
            'siswa_id.*' => 'exists:siswa,id',
        ]);

        // Ensure the kelas exists
        $kelas = Kelas::findOrFail($kelasId);

        // Insert students into kelas_siswa
        foreach ($request->siswa_id as $siswaId) {
            KelasSiswa::updateOrCreate(
                [
                    'id_kelas' => $kelasId,
                    'id_siswa' => $siswaId,
                ],
                [
                    'status' => $request->status,
                    'is_active' => true,
                    'tahun_ajaran' => date('Y'), // or fetch from settings
                ]
            );
        }

        return redirect()->back()->with('success', 'Siswa berhasil ditambahkan ke kelas.');
    }


   public function showSiswaByKelas($id_kelas)
{
    // Ambil data kelas
    $kelas = Kelas::findOrFail($id_kelas);
    
    // Ambil relasi siswa melalui tabel pivot
    $siswaDiKelas = KelasSiswa::with(['siswa', 'kelas'])
        ->where('id_kelas', $id_kelas)
        ->where('is_active', 1) // hanya yang aktif
        ->orderBy('created_at', 'desc')
        ->get();

    return view('halaman-admin.kelas.detailSiswa', [
        'kelas' => $kelas,
        'siswaDiKelas' => $siswaDiKelas
    ]);
}


    public function bulkUpdate(Request $request, $id)
    {
        $request->validate([
            'action' => 'required|in:naik,tidak_naik'
        ]);

        // Ambil semua siswa di kelas ini
        $siswaIds = KelasSiswa::where('id_kelas', $id)
            ->pluck('id_siswa');

        // Update status dan is_active berdasarkan aksi
        foreach ($siswaIds as $siswaId) {
            KelasSiswa::where('id_siswa', $siswaId)
                ->where('id_kelas', $id)
                ->update([
                    'status' => $request->action,
                    'is_active' => ($request->action == 'naik') ? false : true
                ]);
        }

        return back()->with('success', 'Status siswa berhasil diperbarui secara massal');
    }

    public function removeSiswa($kelasId, $siswaId)
    {
        KelasSiswa::where('id_kelas', $kelasId)
            ->where('id_siswa', $siswaId)
            ->delete();

        return back()->with('success', 'Siswa berhasil dikeluarkan dari kelas');
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
