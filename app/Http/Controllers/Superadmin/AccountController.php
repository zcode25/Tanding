<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AccountController extends Controller
{
    public function index(User $user) {
        $superadmin = $user;

        return view('superadmin.account.index', [
            'superadmin' => $superadmin
        ]);
    }

    public function update(Request $request, User $user) {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|max:15',
            'address' => 'required|max:255',
        ]);

        User::where('id', $user->id)->update($validatedData);

        return redirect()->back()->with('success', 'Data Berhasil Disimpan');
    }

    public function resetPassword(Request $request, User $user) {

        $validatedData = $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $validatedData['password'] = bcrypt($request->password);
        
        User::where('id', $user->id)->update($validatedData);

        return redirect()->back()->with('success', 'Kata sandi berhasil diubah');
    }
}
