<?php

namespace App\Http\Controllers;


use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class EkstrakurikulerController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $ekstrakurikulers = DB::table('ekstrakurikuler')
            ->join('kategori', 'ekstrakurikuler.id_kategori', '=', 'kategori.id')
            ->select('ekstrakurikuler.*', 'kategori.nama_kategori as kategori')
            ->get();

        return view('halaman-admin.ekstrakurikuler.index', compact('ekstrakurikulers'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        $kategori = Kategori::all();
        return view('halaman-admin.ekstrakurikuler.create', compact('kategori'));
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {

        $data = $request->except('Gambar'); // Ambil semua data kecuali Gambar

        // Proses upload file manual dengan move()
        if ($request->hasFile('Gambar')) {
            $file = $request->file('Gambar');
            $filename = time() . '_' . $file->getClientOriginalName(); // Contoh: 1713456_namafile.jpg
            $destinationPath = public_path('storage/images'); // Pastikan folder ini sudah ada dan writable

            $file->move($destinationPath, $filename);

            // Simpan path relatif ke DB (misalnya 'images/nama_file.jpg')
            $data['Gambar'] = 'images/' . $filename;
        }

        Ekstrakurikuler::create($data);

        return redirect('/ekstrakurikuler')->with('success', 'Ekstrakurikuler created successfully.');
    }
    // Display the specified resource
    public function show($id)
    {
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
        return view('ekstrakurikuler.show', compact('ekstrakurikuler'));
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
        $kategori = Kategori::all(); // Ambil semua kategori untuk dropdown
        return view('halaman-admin.ekstrakurikuler.edit', compact('ekstrakurikuler', 'kategori'));
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'nama_ekstrakurikuler' => 'required|string|max:255',
        //     'Gambar' => 'nullable|image',
        //     'Jadwal' => 'required|string',
        //     'Deskripsi' => 'required|string',
        //     'id_kategori' => 'required|integer',
        //     'Jam_mulai' => 'required',
        //     'Jam_selesai' => 'required',
        //     'Lokasi' => 'required|string',
        //     'Periode' => 'required|string',
        // ]);

        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('Gambar')) {
            $data['Gambar'] = $request->file('Gambar')->store('images', 'public');
        }

        $ekstrakurikuler->update($data);

        return redirect()->route('ekstrakurikuler.index')->with('success', 'Ekstrakurikuler updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
        $ekstrakurikuler->delete();

        return redirect()->route('ekstrakurikuler.index')->with('success', 'Ekstrakurikuler deleted successfully.');
    }
}
