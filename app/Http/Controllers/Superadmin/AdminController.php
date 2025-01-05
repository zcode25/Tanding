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

        return redirect('/superadminAdmin')->with('success', 'Data saved successfully');
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
            'email' => 'required|max:255',
            'phone' => 'required|max:15',
            'address' => 'required|max:255',
        ]);

        if ($request->email == $user->email) {
            $validatedData['email'] = $request->email;
        }

        User::where('id', $user->id)->update($validatedData);

        return redirect('/superadminAdmin')->with('success', 'Data updated successfully');

    }

    public function destroy(User $user) {
        User::where('id', $user->id)->delete();
        return redirect('/superadminAdmin')->with('success', 'Data deleted successfully');
    }
    
}
