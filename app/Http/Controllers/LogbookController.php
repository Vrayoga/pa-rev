<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Middleware\CheckAbsensiSession;

class LogbookController extends Controller
{

 
    // Tampilkan semua logbook
    public function index()
    {
        // Menampilkan semua logbook, termasuk yang terkunci
        $logbooks = Logbook::join('ekstrakurikuler', 'logbook.ekstrakurikuler_id', '=', 'ekstrakurikuler.id')
            ->select(
                'logbook.*',
                'ekstrakurikuler.nama_ekstrakurikuler as nama_ekstrakurikuler'
            )
            ->get();

        return view('halaman-admin.logbook.index', compact('logbooks'));
    }



    // Tampilkan form tambah
    public function create()
    {
        $ekstrakurikuler = Ekstrakurikuler::select('id', 'nama_ekstrakurikuler')->get(); // Ambil id dan nama ekstrakurikuler
        return view('halaman-admin.logbook.create', compact('ekstrakurikuler')); // Pastikan view ini ada
    }

    // Simpan data logbook
    public function store(Request $request)
    {
        // dd($request->all()); // Debugging untuk melihat data yang diterima
        // Validasi input
        // $request->validate([
        //     'ekstrakurikuler_id' => 'required|exists:ekstrakurikuler,id',
        //     'Kegiatan' => 'required|string',
        //     'Tanggal' => 'required|date',
        //     'Jam_mulai' => 'required|date_format:H:i',
        //     'Jam_selesai' => 'required|date_format:H:i|after:Jam_mulai',
        //     'Foto_kegiatan' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        // ]);

        $data = $request->except('Foto_kegiatan');
        $data['users_id'] = Auth::id(); // Ambil ID user yang login

        // Upload foto kegiatan menggunakan move()
        if ($request->hasFile('Foto_kegiatan')) {
            $file = $request->file('Foto_kegiatan');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('storage/foto_kegiatan');

            // Buat folder jika belum ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }

            $file->move($destinationPath, $filename);
            $data['Foto_kegiatan'] = 'foto_kegiatan/' . $filename;
        }

        Logbook::create($data);

        return redirect('/logbook')->with('success', 'Logbook berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $logbook = Logbook::findOrFail($id);
        $ekstrakurikuler = Ekstrakurikuler::all();

        return view('halaman-admin.logbook.edit', compact('logbook', 'ekstrakurikuler'));
    }



    public function update(Request $request, $id)
    {

        $logbook = Logbook::findOrFail($id);
        $data = $request->except('Gambar');

        if ($request->hasFile('Gambar')) {
            $file = $request->file('Gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('storage/images');

            // Buat folder kalau belum ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }

            // Hapus gambar lama jika ada
            if ($logbook->Gambar && file_exists(public_path('storage/' . $logbook->Gambar))) {
                File::delete(public_path('storage/' . $logbook->Gambar));
            }

            // Simpan gambar baru
            $file->move($destinationPath, $filename);
            $data['Gambar'] = 'images/' . $filename;
        }

        $logbook->update($data);

        return redirect('/logbook')->with('success', 'Ekstrakurikuler updated successfully.');
    }

    public function destroy($id)
    {
        $logbook = Logbook::findOrFail($id);
        $logbook->delete();
        return redirect('/logbook')->with('success', 'Kategori berhasil dihapus.');
    }
}
