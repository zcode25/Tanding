<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Age;
use App\Models\Matchclass;

class AgeController extends Controller
{
    public function index() {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $ages = Age::all();

        return view('superadmin.age.index', [
            'ages' => $ages
        ]);
    }

    public function create() {
        return view('superadmin.age.create');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'age_name' => 'required|max:255',
        ]);

        Age::create($validatedData);

        return redirect('/superadminAge')->with('success', 'Data saved successfully');
        
    }

    public function edit(Age $age) {
        return view('superadmin.age.edit', [
            'age' => $age
        ]);
    }

    public function update(Request $request, Age $age) {
        $validatedData = $request->validate([
            'age_name' => 'required|max:255',
        ]);

        Age::where('age_id', $age->age_id)->update($validatedData);

        return redirect('/superadminAge')->with('success', 'Data updated successfully');
        
    }

    public function destroy(Age $age) {

        try{
            Age::where('age_id', $age->age_id)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return redirect('/superadminAge')->with('success', 'Data deleted successfully');  
    }

    public function detail(Age $age) {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $genders = [
            [
                "type" => "Putra"
            ],
            [
                "type" => "Putri"
            ],
        ];

        $classes = Matchclass::where('age_id', $age->age_id)->get();

        return view('superadmin.age.detail', [
            'age' => $age,
            'genders' => $genders,
            'classes' => $classes,
        ]);
    }

    public function classStore(Request $request) {
        $validatedData = $request->validate([
            'age_id' => 'required',
            'class_name' => 'required',
            'class_gender' => 'required',
            'class_min' => 'required',
            'class_max' => 'required',
        ]);

        Matchclass::create($validatedData);
        
        return back()->with('success', 'Data saved successfully');

    }


    public function classDestroy(Matchclass $matchclass) {

        try{
            Matchclass::where('class_id', $matchclass->class_id)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return back()->with('success', 'Data removed successfully');
    }
}
