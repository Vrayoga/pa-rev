<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->input('role');
        
        // Query dasar
        $usersQuery = User::query();
        
        // Filter berdasarkan role jika ada
        if ($role) {
            $usersQuery->role($role);
        }
        
        // Ambil data user
        $users = $usersQuery->get();
        
        // Data untuk view
        $data = [
            'users' => $users
        ];
        
        return view('halaman-admin.user.index', compact('data'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('halaman-admin.user.createUser', compact('roles'));
    }

    public function store(Request $request)
    {

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'nis' => 'required|string|unique:users',
            'role' => 'required|exists:roles,id', // Validasi role ID harus ada di tabel roles
        ]);
    
        // Buat user baru
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'nis' => $validated['nis'],
            'email_verified_at' => now(),
        ]);
    
        // Ambil role berdasarkan ID
        $role = Role::findById($validated['role']);
        
        // Assign role ke user berdasarkan nama
        $user->assignRole($role->name);
    
        // Redirect dengan pesan sukses
        return redirect('/users')->with('success', 'User berhasil dibuat dan diberikan role.');
    }

    
    public function destroy($id)
    {
        $user = User::find($id);
        
        if (!$user) {
            // User tidak ditemukan, redirect dengan pesan error
            return redirect()->route('users.index')->with('error', 'User tidak ditemukan.');
        }
        
        $delete = $user->delete();
        
        if ($delete) {
            return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
        } else {
            return redirect()->route('users.index')->with('error', 'Gagal menghapus user.');
        }
    }
}