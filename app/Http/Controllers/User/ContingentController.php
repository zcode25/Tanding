<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contingent;
use App\Models\User;

class ContingentController extends Controller
{
    public function index() {
        $user_id = auth()->user()->id;

        $contingent = Contingent::where('user_id', $user_id)->first();

        $provinceFile = public_path('json/provinces.json');
        if (file_exists($provinceFile)) {
            $provinces = json_decode(file_get_contents($provinceFile), true);
        } else {
            $provinces = [];
        }

        $cities = [];
        if ($contingent && $contingent->province) {
            $cityFile = public_path('json/cities/kab-' . $contingent->province . '.json');
            if (file_exists($cityFile)) {
                $cities = json_decode(file_get_contents($cityFile), true);
            }
        }

        $user = User::where('id', $user_id)->first();

        return view('user.contingent.index', [
            'contingent' => $contingent,
            'provinces' => $provinces,
            'cities' => $cities,
            'user' => $user
        ]);
    }

    public function update(Request $request, Contingent $contingent) {
        $validatedData = $request->validate([
            'contingent_name' => 'required',
            'province' => 'required',
            'city' => 'required',
        ]);

        Contingent::where('user_id', $contingent->user_id)->update($validatedData);

        return back()->with('success', 'Data Berhasil Disimpan');

    }

    public function updateUser(Request $request, User $user) {
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

        return  back()->with('success', 'Data Berhasil Disimpan');

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
