<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Administrator;
use App\Models\Information;
use App\Models\Banner;
use App\Models\Document;
use App\Models\Competition;
use App\Models\Category;
use App\Models\Age;
use App\Models\Matchclass;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index() {

        $user_id = auth()->user()->id;

        $administrators = Administrator::where('user_id', $user_id)->get();

        return view('admin.event.index', [
            'administrators' => $administrators
        ]);
    }

    public function detail(Event $event) {
        return view('admin.event.detail', [
            'event' => $event
        ]);
    }

    public function information(Event $event) {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $statuses = [
            [
                "status" => "Draft"
            ],
            [
                "status" => "Publish"
            ],
            [
                "status" => "Archive"
            ],
        ];

        $information = Information::where('event_id', $event->event_id)->first();
        $banners = Banner::where('event_id', $event->event_id)->get();
        $documents= Document::where('event_id', $event->event_id)->get();

        return view('admin.event.information.index', [
            'event' => $event,
            'statuses' => $statuses,
            'information' => $information,
            'banners' => $banners,
            'documents' => $documents
        ]);
    }

    public function informationStore(Request $request) {

        $validatedData = $request->validate([
            'event_id' => 'required',
            'title' => 'required|max:255',
            'description' => 'required',
            'open_reg' => 'required',
            'close_reg' => 'required',
            'start_match' => 'required',
            'end_match' => 'required',
            'quota' => 'required',
            'status' => 'required',
        ]);

        $information = Information::where('event_id', $request->event_id)->first();

        if($information) {
            $event_id = $validatedData['event_id'];
            information::where('event_id', $event_id)->update($validatedData);
        } else {
            Information::create($validatedData);
        }

        return back()->with('success', 'Data Berhasil Disimpan');
    }


    public function bannerStore(Request $request) {

        $validatedData = $request->validate([
            'event_id' => 'required',
            'banner_img' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        if($request->file('banner_img')) {
            $validatedData['banner_img'] = $request->file('banner_img')->store('banner_img');
        }

        Banner::create($validatedData);

        return back()->with('success', 'Data Berhasil Disimpan');
    }

    public function bannerDestroy(Banner $banner) {

        $banner_img = Banner::where('banner_id', $banner->banner_id)->first();

        try{
            Storage::delete($banner_img->banner_img);
            Banner::where('banner_id', $banner->banner_id)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data tidak dapat dihapus, karena data masih diperlukan!',
            ]);
        }

        return back()->with('success', 'Data Berhasil Dihapus');
    }

    public function document(Event $event) {

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $documents= Document::where('event_id', $event->event_id)->get();

        return view('admin.event.document.index', [
            'event' => $event,
            'documents' => $documents
        ]);

    }

    public function documentStore(Request $request) {
        $validatedData = $request->validate([
            'event_id' => 'required',
            'document_name' => 'required',
            'document' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
        ]);

        if($request->file('document')) {
            $validatedData['document'] = $request->file('document')->store('document');
        }

        Document::create($validatedData);

        return back()->with('success', 'Data Berhasil Disimpan');

    }

    public function documentDestroy(Document $document) {

        $document = Document::where('document_id', $document->document_id)->first();

        try{
            Storage::delete($document->document);
            Document::where('document_id', $document->document_id)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return back()->with('success', 'Data Berhasil Dihapus');
    }

    public function competition(Event $event) {

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $categories = Category::where('event_id', $event->event_id)->get();
        $ages = Age::where('event_id', $event->event_id)->get();
        $competitions = Competition::where('event_id', $event->event_id)->get();

        $genders = [
            [
                "type" => "Putra"
            ],
            [
                "type" => "Putri"
            ],
        ];
        
        return view('admin.event.competition.index', [
            'event' => $event,
            'categories' => $categories,
            'ages' => $ages,
            'competitions' => $competitions,
            'genders' => $genders,
        ]);
    }

    public function competitionStore(Request $request) {
        // dd($request);

        $validatedData = $request->validate([
            'event_id' => 'required',
            'category_id' => 'required',
            'age_id' => 'required',
            'gender' => 'required',
            'price' => 'required',
        ]);

        Competition::create($validatedData);

        return back()->with('success', 'Data Berhasil Disimpan');
    }


    public function competitionDestroy(Competition $competition) {

        try{
            Competition::where('competition_id', $competition->competition_id)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return back()->with('success', 'Data Berhasil Dihapus');
    }

    public function category(Event $event) {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $categories = Category::where('event_id', $event->event_id)->get();

        return view('admin.event.category.index' , [
            'categories' => $categories,
            'event' => $event
        ]);
    }

    public function categoryCreate(Event $event) {
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

        return view('admin.event.category.create', [
            'types' => $types,
            'event' => $event,
            'amounts' => $amounts,
        ]);
    }

    public function categoryStore(Request $request) {
        $validatedData = $request->validate([
            'event_id' => 'required',
            'category_name' => 'required|max:255',
            'category_type' => 'required',
            'category_amount' => 'required',
        ]);

        Category::create($validatedData);

        return redirect('/adminEvent/category/'. $validatedData['event_id'])->with('success', 'Data Berhasil Disimpan');
    }

    public function categoryEdit(Category $category) {

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

        $event = Event::where('event_id', $category->event_id)->first();

        
        return view('admin.event.category.edit' , [
            'event' => $event,
            'category' => $category,
            'types' => $types,
            'amounts' => $amounts
        ]);
    }

    public function categoryUpdate(Request $request, Category $category) {
        $validatedData = $request->validate([
            'event_id' => 'required',
            'category_name' => 'required|max:255',
            'category_type' => 'required',
            'category_amount' => 'required',
        ]);

        Category::where('category_id', $category->category_id)->update($validatedData);

        return redirect('/adminEvent/category/'. $validatedData['event_id'])->with('success', 'Data Berhasil Disimpan');        
    }

    public function categoryDestroy(Category $category) {

        try{
            Category::where('category_id', $category->category_id)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return back()->with('success', 'Data Berhasil Dihapus');
    }

    public function age(Event $event) {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $ages = Age::where('event_id', $event->event_id)->get();

        return view('admin.event.age.index', [
            'event' => $event,
            'ages' => $ages,
        ]);
    }

    public function ageCreate(Event $event) {
        return view('admin.event.age.create', [
            'event' => $event
        ]);
    }

    public function ageStore(Request $request) {
        $validatedData = $request->validate([
            'event_id' => 'required',
            'age_name' => 'required|max:255',
        ]);

        Age::create($validatedData);

        return redirect('/adminEvent/age/'. $validatedData['event_id'])->with('success', 'Data saved successfully');
        
    }

    public function ageEdit(Age $age) {

        $event = Event::where('event_id', $age->event_id)->first();

        return view('admin.event.age.edit', [
            'event' => $event,
            'age' => $age
        ]);
    }

    public function ageUpdate(Request $request, Age $age) {
        $validatedData = $request->validate([
            'event_id' => 'required',
            'age_name' => 'required|max:255',
        ]);

        Age::where('age_id', $age->age_id)->update($validatedData);

        return redirect('/adminEvent/age/'. $validatedData['event_id'])->with('success', 'Data updated successfully');
        
    }

    public function ageDestroy(Age $age) {

        try{
            Age::where('age_id', $age->age_id)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return back()->with('success', 'Data Berhasil Dihapus');
    }

    public function ageDetail(Age $age) {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);


        $classes = Matchclass::where('age_id', $age->age_id)->get();
        $event = Event::where('event_id', $age->event_id)->first();


        return view('admin.event.age.detail', [
            'event' => $event,
            'age' => $age,
            'classes' => $classes,
        ]);
    }
    
    public function classStore(Request $request) {
        $validatedData = $request->validate([
            'age_id' => 'required',
            'class_name' => 'required',
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
