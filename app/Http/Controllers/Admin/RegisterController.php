<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Register;
use App\Models\Athlete;
use App\Models\Competition;
use App\Models\Category;

class RegisterController extends Controller
{
    public function index(Event $event) {

        $registers = Register::with(['category', 'age', 'matchClass', 'athletes'])
        ->where('event_id', $event->event_id)
        ->where('status', 'Match')
        ->get();

        $competitions = Competition::where('event_id', $event->event_id)->get();
        $groupedCompetitions = $competitions->groupBy('category_id');


        return view('admin.event.register.index', [
            'event' => $event,
            'registers' => $registers,
            'groupedCompetitions' => $groupedCompetitions
        ]);

    }

    public function detail(Competition $competition) {

        $event = Event::where('event_id', $competition->event_id)->first();
        $category = Category::where('category_id', $competition->category_id)->first();

        $registers = Register::with(['category', 'age', 'matchClass', 'athletes'])
        ->where('event_id', $event->event_id)
        ->where('category_id', $competition->category_id)
        ->where('status', 'Match')
        ->get();

        return view('admin.event.register.detail', [
            'registers' => $registers,
            'category' => $category,
            'event' => $event,
        ]);

    }

    public function edit(Register $register) {
        
        $register = Register::with(['category', 'age', 'matchClass', 'athletes'])
        ->where('register_id', $register->register_id)
        ->first();

        $event = Event::where('event_id', $register->event_id)->first();
        

        return view('admin.event.register.edit', [
            'register' => $register,
            'event' => $event,
        ]);
    }
}
