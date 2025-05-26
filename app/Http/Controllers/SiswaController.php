<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Validators\ValidationException;
use App\Imports\SiswaImport; // Import class SiswaImport
use Maatwebsite\Excel\Validators\ValidationException as MaatwebsiteValidationException;

class SiswaController extends Controller
{
    // Tampilkan semua siswa
    public function index()
    {
        $siswa = Siswa::all();
        return view('halaman-admin.siswa.index', compact('siswa'));
    }


public function import(Request $request)
{
    Excel::import(new SiswaImport, $request->file('file_siswa'));

    return redirect()->back()->with('success', 'Data berhasil diimpor');
}

    // Tampilkan form tambah siswa
    public function create()
    {
        return view('halaman-admin.siswa.create');
    }
    public function store(Request $request)
    {

        $request->validate([
            'nisn' => 'required|string|max:20|unique:siswa,nisn',
            'nama_siswa' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'tempat' => 'required|string|max:10',
            'tanggal_lahir' => 'required|string|max:10',
            'kelas' => 'required|string|max:30',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'agama' => 'required|in:islam,kristen,katolik,hindu,buddha,konghucu',
            'no_telepon' => 'required|string|max:20',
            'tahun_masuk' => 'required|string|max:20',
        ]);

        $data = $request->only([
            'nisn',
            'nama_siswa',
            'email',
            'tempat',
            'tanggal_lahir',
            'kelas',
            'jenis_kelamin',
            'agama',
            'no_telepon',
            'tahun_masuk',
        ]);

        Siswa::create($data);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
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
