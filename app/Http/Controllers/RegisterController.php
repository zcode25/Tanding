<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contingent;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function index() {
        return view('register.index');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users',
            'phone' => 'required|max:15',
            'address' => 'required|max:255',
            'password' => 'required|min:8|max:50',
            'contingent_name' => 'required',
            'province' => 'required',
            'city' => 'required',
        ]);

        $validatedData['password'] = Hash::make($request['password']);
        $validatedData['role'] = 'User';
    
        // Simpan data ke tabel users
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
            'role' => $validatedData['role'],
            'password' => $validatedData['password'],
        ]);
    
        // Gunakan ID pengguna yang baru dibuat untuk menyimpan data kontingen
        Contingent::create([
            'contingent_name' => $validatedData['contingent_name'],
            'user_id' => $user->id, // Ambil ID dari user yang baru saja dibuat
            'province' => $validatedData['province'],
            'city' => $validatedData['city'],
        ]);
    
        return redirect('/login')->with('success', 'Data Berhasil Disimpan');
    }
    
}
