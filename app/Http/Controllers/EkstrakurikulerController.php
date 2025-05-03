<?php

namespace App\Http\Controllers;


use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class EkstrakurikulerController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        // Ambil user login
        $user = auth()->user();
    
        // Cek role jika perlu (opsional, jika multi-role)
        if ($user->hasRole('guru')) {
            // Jika guru, ambil hanya ekstrakurikuler yang dia ampu
            $ekstrakurikulers = Ekstrakurikuler::with(['jadwals', 'kategori', 'user'])
                ->where('id_users', $user->id)
                ->get();
        } else {
            // Jika admin atau role lain, ambil semua data
            $ekstrakurikulers = Ekstrakurikuler::with(['jadwals', 'kategori', 'user'])->get();
        }
    
        return view('halaman-admin.ekstrakurikuler.index', compact('ekstrakurikulers'));
    }
    

    // index siswa(tampilan untuk users)
    public function indexSiswa()
    {
        $ekstrakurikulers = Ekstrakurikuler::with(['jadwals', 'kategori'])->get();
        return view('users.index', compact('ekstrakurikulers'));
    }
    


    // Show the form for creating a new resource
    public function create()
    {
        $kategori = Kategori::all();
        $gurus = User::role('guru')->get(); // Ambil semua user dengan role guru    
        return view('halaman-admin.ekstrakurikuler.create', compact('kategori', 'gurus'));
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
        $ekstrakurikuler = Ekstrakurikuler::with('kategori')->findOrFail($id);
        return view('users.detailEkstra', compact('ekstrakurikuler'));
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
        $kategori = Kategori::all(); // Ambil semua kategori untuk dropdown
        $gurus = \App\Models\User::role('guru')->get(); // Ambil semua user dengan role guru
        return view('halaman-admin.ekstrakurikuler.edit', compact('ekstrakurikuler', 'kategori', 'gurus'));
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
