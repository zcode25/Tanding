<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Register;
use App\Models\Athlete;
use App\Models\Competition;
use App\Models\Category;
use App\Models\Draw;
use App\Models\Matchclass;
use App\Models\Age;
use App\Models\Participant;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ParticipantImport;
use App\Exports\ParticipantsExport;

class DrawController extends Controller
{
    public function index(Event $event) {

        $competitions = Competition::where('event_id', $event->event_id)->get();
        $groupedCompetitions = $competitions->groupBy('category_id');

        return view('admin.event.draw.index', [
            'event' => $event,
            'groupedCompetitions' => $groupedCompetitions,
        ]);
    }

    public function detail(Competition $competition) {

        $event = Event::where('event_id', $competition->event_id)->first();
        $competitions = Competition::where('event_id', $event->event_id)->where('category_id', $competition->category_id)->get();
        $category = Category::where('category_id', $competition->category_id)->first();

        $groupedAges = $competitions;

        return view('admin.event.draw.detail', [
            'event' => $event,
            'groupedAges' => $groupedAges,
            'category' => $category,
        ]);

    }


    public function tanding(Competition $competition) {

        $event = Event::where('event_id', $competition->event_id)->first();
        $groupedClasses = Matchclass::where('age_id', $competition->age_id)->get();

        $category = Category::where('category_id', $competition->category_id)->first();
        $age = Age::where('age_id', $competition->age_id)->first();

        return view('admin.event.draw.tanding', [
            'event' => $event,
            'groupedClasses' => $groupedClasses,
            'category' => $category,
            'age' => $age,
            'competition' => $competition
        ]);

    }



    public function tandingDraw(Competition $competition, Matchclass $matchclass) {

        $event = Event::where('event_id', $competition->event_id)->first();
        $category = Category::where('category_id', $competition->category_id)->first();
        $age = Age::where('age_id', $competition->age_id)->first();

        $participants = Participant::where('event_id', $competition->event_id)->where('category_id', $competition->category_id)->where('age_id', $competition->age_id)->where('class_id', $matchclass->class_id)->where('gender', $competition->gender)->get();

        return view('admin.event.draw.tandingDraw', [
            'event' => $event,
            'category' => $category,
            'age' => $age,
            'competition' => $competition,
            'matchclass' => $matchclass,
            'participants' => $participants,
        ]);
    }

    public function tgrDraw(Competition $competition) {

        $event = Event::where('event_id', $competition->event_id)->first();
        $category = Category::where('category_id', $competition->category_id)->first();
        $age = Age::where('age_id', $competition->age_id)->first();

        $participants = Participant::where('event_id', $competition->event_id)->where('category_id', $competition->category_id)->where('age_id', $competition->age_id)->where('gender', $competition->gender)->get();

        return view('admin.event.draw.tgrDraw', [
            'event' => $event,
            'category' => $category,
            'age' => $age,
            'competition' => $competition,
            'participants' => $participants,
        ]);
    }

    public function randomDraw()
    {
        $participants = Participant::inRandomOrder()->get();

        foreach ($participants as $index => $participant) {
            $participant->draw_number = $index + 1;
            $participant->is_drawn = true;
        }

        return response()->json([
            'participants' => $participants
        ]);
    }

    public function saveDraw(Request $request)
    {
        $results = $request->input('results');

        foreach ($results as $participantId => $drawNumber) {
            Participant::where('participant_id', $participantId)->update([
                'draw_number' => $drawNumber,
                'is_drawn' => true
            ]);
        }

        return back()->with('success', 'Data peserta berhasil diacak!');
    }

    public function tandingExportDraw(Competition $competition, Matchclass $matchclass)
    {
        $event = Event::where('event_id', $competition->event_id)->first();
        $category = Category::where('category_id', $competition->category_id)->first();
        $age = Age::where('age_id', $competition->age_id)->first();

        $participants = Participant::where('event_id', $competition->event_id)->where('category_id', $competition->category_id)->where('age_id', $competition->age_id)->where('gender', $competition->gender)->where('class_id', $matchclass->class_id)->orderBy('draw_number', 'ASC')->get();

        return Excel::download(new ParticipantsExport($participants), 'participants.xlsx');
    }

    public function tgrExportDraw(Competition $competition)
    {
        $event = Event::where('event_id', $competition->event_id)->first();
        $category = Category::where('category_id', $competition->category_id)->first();
        $age = Age::where('age_id', $competition->age_id)->first();

        $participants = Participant::where('event_id', $competition->event_id)->where('category_id', $competition->category_id)->where('age_id', $competition->age_id)->where('gender', $competition->gender)->orderBy('draw_number', 'ASC')->get();

        return Excel::download(new ParticipantsExport($participants), 'participants.xlsx');
    }

  
}
