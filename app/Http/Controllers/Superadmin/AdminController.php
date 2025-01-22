<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index() {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $admins = User::where('role', 'Admin')->get();

        return view('superadmin.admin.index', [
            'admins' => $admins
        ]);
    }

    public function create() {
        return view('superadmin.admin.create');
    }

    public function store(Request $request) {

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users',
            'phone' => 'required|max:15',
            'address' => 'required|max:255',
            'password' => 'required|min:8|max:50',
        ]);

        $validatedData['role'] = 'Admin';
        $validatedData['password'] = Hash::make($request["password"]);

        User::create($validatedData);

        return redirect('/superadminAdmin')->with('success', 'Data Berhasil Disimpan');
    }

    public function edit(User $user) {

        $admin = $user;

        return view('superadmin.admin.edit', [
            'admin' => $admin
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

        return redirect('/superadminAdmin')->with('success', 'Data Berhasil Disimpan');

    }

    public function resetPassword(Request $request, User $user) {

        $validatedData = $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $validatedData['password'] = bcrypt($request->password);
        
        User::where('id', $user->id)->update($validatedData);

        return redirect()->back()->with('success', 'Kata sandi berhasil diubah');
    }

    public function destroy(User $user) {
        try{
            User::where('id', $user->id)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data tidak dapat dihapus, karena data masih diperlukan!',
            ]);
        }
       
        return redirect('/superadminAdmin')->with('success', 'Data Berhasil Dihapus');
    }
    
}
