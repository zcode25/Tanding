<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Models\Administrator;

class EventController extends Controller
{
    public function index() {

        $events = Event::all();

        return view('superadmin.event.index', [
            'events' => $events
        ]);
    }

    public function create() {
        return view('superadmin.event.create');
    }

    public function store(Request $request) {

        $validatedData = $request->validate([
            'event_name' => 'required|max:255',
            'event_desc' => 'required|max:255',
        ]);

        Event::create($validatedData);

        return redirect('/superadminEvent')->with('success', 'Data saved successfully');

    }

    public function edit(Event $event) {
        return view('superadmin.event.edit', [
            'event' => $event
        ]);
    }

    public function update(Request $request, Event $event) {

        $validatedData = $request->validate([
            'event_name' => 'required|max:255',
            'event_desc' => 'required|max:255',
        ]);

        Event::where('event_id', $event->event_id)->update($validatedData);

        return redirect('/superadminEvent')->with('success', 'Data updated successfully');

    }

    public function detail(Event $event) {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $admins = User::where('role', 'Admin')
        ->whereNotIn('id', function ($query) use ($event) {
            $query->select('user_id')
                  ->from('administrators')
                  ->where('event_id', $event->event_id);
        })
        ->get();

        $administrators = Administrator::where('event_id', $event->event_id)->get();
    
        return view('superadmin.event.detail', [
            'event'             => $event,
            'admins'            => $admins,
            'administrators'    => $administrators,
        ]);
    
    }

    public function adminStore(Request $request) {

        $validatedData = $request->validate([
            'event_id' => 'required',
            'user_id' => 'required',
        ]);

        Administrator::create($validatedData);

        return redirect('/superadminEvent/detail/'. $validatedData['event_id'])->with('success', 'Data saved successfully');
    }

    public function adminDestroy(Administrator $administrator) {

        try{
            Administrator::where('administrator_id', $administrator->administrator_id)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return back()->with('success', 'Data deleted successfully');
    }

}
