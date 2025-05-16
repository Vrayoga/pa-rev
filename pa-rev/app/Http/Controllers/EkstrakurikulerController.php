<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Kategori;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

// menampilkan anggota ekstrakurikuler saat sudah keterima di ekstrakurikuler
public function showAnggota($id)
{
    $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
    $user = Auth::user();
    
    // Jika user adalah guru, pastikan dia pembimbing ekstra ini
    if ($user->hasRole('guru')) {
        $ekstraGuru = $user->ekstrakurikuler->pluck('id')->toArray();
        
        if (!in_array($ekstrakurikuler->id, $ekstraGuru)) {
            return back()->with('error', 'Anda tidak berhak melihat anggota ekstrakurikuler ini');
        }
    }
    
    // Ambil pendaftaran yang sudah diterima untuk ekstra ini
    $anggota = Pendaftaran::where('ekstrakurikuler_id', $id)
                ->where('status_validasi', 'diterima')
                ->with(['kelas', 'user'])
                ->get();
    
    return view('halaman-admin.ekstrakurikuler.anggotaEkstra', [
        'anggota' => $anggota,
        'ekstrakurikuler' => $ekstrakurikuler
    ]);
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

        $data = $request->except('gambar'); // Ambil semua data kecuali gambar

        // Proses upload file manual dengan move()
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName(); // Contoh: 1713456_namafile.jpg
            $destinationPath = public_path('storage/images'); // Pastikan folder ini sudah ada dan writable

            $file->move($destinationPath, $filename);

            // Simpan path relatif ke DB (misalnya 'images/nama_file.jpg')
            $data['gambar'] = 'images/' . $filename;
        }

        Ekstrakurikuler::create($data);

        return redirect('/ekstrakurikuler')->with('success', 'Ekstrakurikuler created successfully.');
    }

    
    // Display the specified resource
    public function show($id)
    {
        $ekstrakurikuler = Ekstrakurikuler::with(['user','jadwals', 'kategori'])
            ->withCount([
                'pendaftaran as jumlah_anggota' => function($query) {
                    $query->where('status_validasi', 'diterima');
                }
            ])
            ->findOrFail($id);
    
        // Hitung persentase kuota hanya jika bukan wajib
        if ($ekstrakurikuler->jenis === 'wajib') {
            $ekstrakurikuler->persentase_kuota = null;
            $ekstrakurikuler->sisa_kuota = 'Tak Terbatas';
        } else {
            $ekstrakurikuler->persentase_kuota = $ekstrakurikuler->kuota > 0 
                ? min(100, round(($ekstrakurikuler->jumlah_anggota / $ekstrakurikuler->kuota) * 100))
                : 0;
            $ekstrakurikuler->sisa_kuota = max(0, $ekstrakurikuler->kuota - $ekstrakurikuler->jumlah_anggota);
        }

    
        return view('users.detailEkstra', compact('ekstrakurikuler'));
    }
    

    // Show the form for editing the specified resource
    public function edit($id)
    {
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
        $kategori = Kategori::all(); // Ambil semua kategori untuk dropdown
        $gurus = User::role('guru')->get(); // Ambil semua user dengan role guru
        return view('halaman-admin.ekstrakurikuler.edit', compact('ekstrakurikuler', 'kategori', 'gurus'));
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
        $data = $request->except('gambar'); // Ambil semua data kecuali gambar
    
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('storage/images');
    
            // Pindahkan file
            $file->move($destinationPath, $filename);
    
            // Simpan path relatif
            $data['gambar'] = 'images/' . $filename;
    
            // Optional: hapus file lama jika perlu
            // $oldImage = public_path('storage/' . $ekstrakurikuler->Gambar);
            // if (file_exists($oldImage)) {
            //     unlink($oldImage);
            // }
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
