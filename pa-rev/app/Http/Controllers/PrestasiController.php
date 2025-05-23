<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Prestasi;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;
use Illuminate\Routing\Controller;

class PrestasiController extends Controller
{

    public function index()
    {
        $prestasis = Prestasi::with(['siswa', 'ekstrakurikuler'])->latest()->paginate(10);
        return view('halaman-admin.prestasi.index', compact('prestasis'));
    }


    public function create()
    {
        // Mengambil data pendaftaran, siswa, dan ekstrakurikuler
        $pendaftarans = Pendaftaran::with(['siswa', 'ekstrakurikuler'])->get();
        $siswas = Siswa::where('status', 'tidak_aktif')->get();
        $ekstrakurikulers = Ekstrakurikuler::all();

        // Mengembalikan view dengan data yang diperlukan
        return view('halaman-admin.prestasi.create', [
            'pendaftarans' => $pendaftarans,
            'siswas' => $siswas,
            'ekstrakurikulers' => $ekstrakurikulers,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:100',
            'peringkat' => 'required|string|max:50',
            'tanggal_kejuaraan' => 'required|date',
            'tingkat_kejuaraan' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'foto_prestasi' => 'required|image|max:2048',
            'pendaftaran_id' => 'nullable|exists:pendaftaran,id',
            'siswa_id' => 'nullable|exists:siswa,id',
            'ekstrakurikuler_id' => 'nullable|exists:ekstrakurikuler,id',
        ]);

        // Validasi logika
        if (!$request->pendaftaran_id && (!$request->siswa_id || !$request->ekstrakurikuler_id)) {
            return back()->withErrors(['error' => 'Untuk alumni, siswa dan ekstrakurikuler wajib diisi.']);
        }

        $prestasi = new Prestasi();
        $prestasi->nama_kegiatan = $request->nama_kegiatan;
        $prestasi->peringkat = $request->peringkat;
        $prestasi->tanggal_kejuaraan = $request->tanggal_kejuaraan;
        $prestasi->tingkat_kejuaraan = $request->tingkat_kejuaraan;
        $prestasi->deskripsi = $request->deskripsi;

        if ($request->hasFile('foto_prestasi')) {
            $file = $request->file('foto_prestasi');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('storage/images');
            $file->move($destinationPath, $filename);
            $prestasi->foto_prestasi = $filename;
        }

        if ($request->pendaftaran_id) {
            $pendaftaran = Pendaftaran::with('siswa', 'ekstrakurikuler')->findOrFail($request->pendaftaran_id);
            $prestasi->pendaftaran_id = $pendaftaran->id;
            $prestasi->siswa_id = $pendaftaran->siswa_id;
            $prestasi->ekstrakurikuler_id = $pendaftaran->ekstrakurikuler_id;
        } else {
            $prestasi->siswa_id = $request->siswa_id;
            $prestasi->ekstrakurikuler_id = $request->ekstrakurikuler_id;
        }

        $prestasi->save();

        return redirect()->route('prestasi.index')->with('success', 'Data prestasi berhasil disimpan.');
    }
}
