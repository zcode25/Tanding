<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('login.index');
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email'     => 'required',
            'password'  => 'required',
        ]);

        if (Auth::attempt(['email' =>  $credentials['email'], 'password' => $credentials['password'], 'role' => 'Superadmin'])) {
            $request->session()->regenerate();
            return redirect()->intended('/superadminDashboard');
        }

        if (Auth::attempt(['email' =>  $credentials['email'], 'password' => $credentials['password'], 'role' => 'Admin'])) {
            $request->session()->regenerate();
            return redirect()->intended('/adminDashboard');
        }

        if (Auth::attempt(['email' =>  $credentials['email'], 'password' => $credentials['password'], 'role' => 'User'])) {
            return 'user';
            // $request->session()->regenerate();
            // return redirect()->intended('/client/ticket');
        }

        return back()->with([
            'loginError' => 'Login field!',
        ]);

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

}
