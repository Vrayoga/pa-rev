<?php

namespace App\Http\Controllers;

use App\Models\JadwalEkstrakurikuler;
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;

class jadwalEkstrakurikulerController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $user = auth()->user();
    
        if ($user->hasRole('guru')) {
            // Guru hanya melihat jadwal dari ekstrakurikuler yang dia ampu
            $jadwal = JadwalEkstrakurikuler::join('ekstrakurikuler', 'jadwal_ekstrakurikuler.ekstrakurikuler_id', '=', 'ekstrakurikuler.id')
                ->where('ekstrakurikuler.id_users', $user->id)
                ->select('jadwal_ekstrakurikuler.*', 'ekstrakurikuler.nama_ekstrakurikuler as nama_ekstrakurikuler')
                ->get();
    
            $ekstrakurikuler = Ekstrakurikuler::where('id_users', $user->id)->get();
        } else {
            // Admin bisa melihat semua
            $jadwal = JadwalEkstrakurikuler::join('ekstrakurikuler', 'jadwal_ekstrakurikuler.ekstrakurikuler_id', '=', 'ekstrakurikuler.id')
                ->select('jadwal_ekstrakurikuler.*', 'ekstrakurikuler.nama_ekstrakurikuler as nama_ekstrakurikuler')
                ->get();
    
            $ekstrakurikuler = Ekstrakurikuler::all();
        }
    
        return view('halaman-admin.jadwal-ekstrakurikuler.index', compact('jadwal', 'ekstrakurikuler'));
    }
    

    // Show the form for creating a new resource
    public function create()
    {
        $user = auth()->user();
    
        if ($user->hasRole('guru')) {
            // Guru hanya boleh memilih ekstrakurikuler yang dia ampu
            $ekstrakurikuler = Ekstrakurikuler::where('id_users', $user->id)->get();

    
            if ($ekstrakurikuler->isEmpty()) {
                return redirect()->route('jadwal.index')->with('error', 'Anda belum mengampu ekstrakurikuler.');
            }
        } else {
            // Admin bisa memilih semua
            $ekstrakurikuler = Ekstrakurikuler::all();
        }
    
        return view('halaman-admin.jadwal-ekstrakurikuler.create', compact('ekstrakurikuler'));
    }
    

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $request->validate([
            'ekstrakurikuler_id' => 'required|exists:ekstrakurikuler,id',
            'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);
    
        $user = auth()->user();
    
        // Validasi agar guru hanya bisa menambahkan jadwal ke ekstra yang dia ampu
        if ($user->hasRole('guru')) {
            $ekstra = Ekstrakurikuler::where('id', $request->ekstrakurikuler_id)
                        ->where('id_users', $user->id)
                        ->first();
    
            if (!$ekstra) {
                return redirect()->route('jadwal.index')->with('error', 'Anda tidak berhak menambahkan jadwal ke ekstrakurikuler ini.');
            }
        }
    
        JadwalEkstrakurikuler::create($request->all());
    
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }
    


    public function edit($id)
    {
        $jadwal = JadwalEkstrakurikuler::findOrFail($id);
        $ekstrakurikuler = Ekstrakurikuler::all();
        return view('halaman-admin.jadwal-ekstrakurikuler.edit', compact('jadwal', 'ekstrakurikuler'));
    }



//uupdate
    public function update(Request $request, $id)
    {
        $request->validate([
            'ekstrakurikuler_id' => 'required|exists:ekstrakurikuler,id',
            'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $jadwal = JadwalEkstrakurikuler::findOrFail($id);
        $jadwal->update($request->all());
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $jadwal = JadwalEkstrakurikuler::findOrFail($id);
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
