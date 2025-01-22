<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index() {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $categories = Category::all();

        return view('superadmin.category.index' , [
            'categories' => $categories
        ]);
    }

    public function create() {
        $types = [
            [
                "type" => "Tanding"
            ],
            [
                "type" => "Seni"
            ],
        ];

        $amounts = [
            [
                "type" => "Single"
            ],
            [
                "type" => "Double"
            ],
            [
                "type" => "Group"
            ],
        ];

        return view('superadmin.category.create', [
            'types' => $types,
            'amounts' => $amounts
        ]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'category_name' => 'required|max:255',
            'category_type' => 'required',
            'category_amount' => 'required',
        ]);

        Category::create($validatedData);

        return redirect('/superadminCategory')->with('success', 'Data Berhasil Disimpan');
    }

    public function edit(Category $category) {

        $types = [
            [
                "type" => "Tanding"
            ],
            [
                "type" => "Seni"
            ],
        ];

        $amounts = [
            [
                "type" => "Single"
            ],
            [
                "type" => "Double"
            ],
            [
                "type" => "Group"
            ],
        ];
        
    
        return view('superadmin.category.edit' , [
            'category' => $category,
            'types' => $types,
            'amounts' => $amounts
        ]);
    }

    public function update(Request $request, Category $category) {
        $validatedData = $request->validate([
            'category_name' => 'required|max:255',
            'category_type' => 'required',
            'category_amount' => 'required',
        ]);

        Category::where('category_id', $category->category_id)->update($validatedData);

        return redirect('/superadminCategory')->with('success', 'Data Berhasil Disimpan');        
    }

    public function destroy(Category $category) {

        try{
            Category::where('category_id', $category->category_id)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return redirect('/superadminCategory')->with('success', 'Data Berhasil Dihapus');  
    }
}
