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
            'status' => 'required',
        ]);

        $information = Information::where('event_id', $request->event_id)->first();

        if($information) {
            $event_id = $validatedData['event_id'];
            information::where('event_id', $event_id)->update($validatedData);
        } else {
            Information::create($validatedData);
        }

        return back()->with('success', 'Data saved successfully');
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

        return back()->with('success', 'Data saved successfully');
    }

    public function bannerDestroy(Banner $banner) {

        $banner_img = Banner::where('banner_id', $banner->banner_id)->first();

        try{
            Storage::delete($banner_img->banner_img);
            Banner::where('banner_id', $banner->banner_id)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return back()->with('success', 'Data deleted successfully');
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

        return back()->with('success', 'Data saved successfully');

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

        return back()->with('success', 'Data deleted successfully');
    }

    public function competition(Event $event) {

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $categories = Category::all();
        $ages = Age::all();
        $competitions = Competition::where('event_id', $event->event_id)->get();
        
        return view('admin.event.competition.index', [
            'event' => $event,
            'categories' => $categories,
            'ages' => $ages,
            'competitions' => $competitions,
        ]);
    }

    public function competitionStore(Request $request) {
        // dd($request);

        $validatedData = $request->validate([
            'event_id' => 'required',
            'category_id' => 'required',
            'age_id' => 'required',
            'price' => 'required',
        ]);

        Competition::create($validatedData);

        return back()->with('success', 'Data saved successfully');
    }


    public function competitionDestroy(Competition $competition) {

        try{
            Competition::where('competition_id', $competition->competition_id)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return back()->with('success', 'Data deleted successfully');
    }


    
}
