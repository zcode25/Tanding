<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Register;
use App\Models\Competition;
use App\Models\Category;
use App\Models\Draw;
use App\Models\Age;
use App\Models\Participant;
use App\Models\Matchtgr;
use App\Models\Matchtanding;

class MatchController extends Controller
{
    public function index(Event $event) {
        $competitions = Competition::join('categories', 'competitions.category_id', '=', 'categories.category_id')
        ->where('competitions.event_id', $event->event_id)
        ->where('categories.category_type', 'Seni')
        ->select('competitions.*')
        ->get();

        $groupedCompetitions = $competitions->groupBy('category_id');

        // dd($groupedCompetitions);

        return view('admin.event.match.index', [
            'event' => $event,
            'groupedCompetitions' => $groupedCompetitions,
        ]);
    }



    public function detail(Competition $competition) {

        $event = Event::where('event_id', $competition->event_id)->first();
        $competitions = Competition::where('event_id', $event->event_id)->where('category_id', $competition->category_id)->get();
        $category = Category::where('category_id', $competition->category_id)->first();

        $groupedAges = $competitions;

        return view('admin.event.match.detail', [
            'event' => $event,
            'groupedAges' => $groupedAges,
            'category' => $category,
        ]);

    }

    public function tanding(Register $register) {

        $event = Event::where('event_id', $register->event_id)->first();
        $category = Category::where('category_id', $register->category_id)->first();

        $registers = Register::with(['category', 'age', 'matchClass', 'athletes'])
        ->where('event_id', $event->event_id)
        ->where('category_id', $register->category_id)
        ->where('age_id', $register->age_id)
        ->get();


        $groupedClasses = $registers->groupBy('class_id');
        $category_name = $registers->first()->category->category_name;
        $age_name = $registers->first()->age->age_name;

        return view('admin.event.match.tanding', [
            'event' => $event,
            'groupedClasses' => $groupedClasses,
            'category_name' => $category_name,
            'age_name' => $age_name,
        ]);

    }

    

    public function tandingMatch(Register $register) {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $event = Event::where('event_id', $register->event_id)->first();
        $category = Category::where('category_id', $register->category_id)->first();

        $registers = Register::with(['category', 'age', 'matchClass', 'athletes'])
        ->where('event_id', $event->event_id)
        ->where('category_id', $register->category_id)
        ->where('age_id', $register->age_id)
        ->where('class_id', $register->class_id)
        ->get();

        // $draws = Draw::with(['category', 'age', 'matchClass', 'register.registerAthletes.athlete'])
        // ->where('event_id', $event->event_id)
        // ->where('category_id', $register->category_id)
        // ->where('age_id', $register->age_id)
        // ->where('class_id', $register->class_id)
        // ->orderBy('draw_number', 'ASC')
        // ->get();

        $drawAthlets = Draw::with(['category', 'age', 'matchClass', 'register.registerAthletes.athlete'])
        ->where('event_id', $event->event_id)
        ->where('category_id', $register->category_id)
        ->where('age_id', $register->age_id)
        ->where('class_id', $register->class_id)
        ->orderBy('draw_number', 'ASC')
        ->get();

       
        $matchtandings = Matchtanding::with([
            'category',
            'age',
            'matchClass',
            'blueCorner.register.registerAthletes.athlete'
        ])
        ->where('event_id', $event->event_id)
        ->where('category_id', $register->category_id)
        ->where('age_id', $register->age_id)
        ->where('class_id', $register->class_id)
        ->get();


        $match_rounds = [
            [
                "match_round" => "Penyisihan"
            ],
            [
                "match_round" => "Seperdelapan Final"
            ],
            [
                "match_round" => "Perempat Final"
            ],
            [
                "match_round" => "Semi Final"
            ],
            [
                "match_round" => "Perebutan Juara 3"
            ],
            [
                "match_round" => "Final"
            ],
        ];

        $category_name = $registers->first()->category->category_name;
        $age_name = $registers->first()->age->age_name;
        $class_name = $registers->first()->matchClass->class_name;

        $category_id = $registers->first()->category->category_id;
        $age_id = $registers->first()->age->age_id;
        $class_id = $registers->first()->matchClass->class_id;

        return view('admin.event.match.tandingMatch', [
            'event' => $event,
            'category_name' => $category_name,
            'age_name' => $age_name,
            'class_name' => $class_name,
            'category_id' => $category_id,
            'age_id' => $age_id,
            'class_id' => $class_id,
            'registers' => $registers,
            // 'draws' => $draws,
            'drawAthlets' => $drawAthlets,
            'matchtandings' => $matchtandings,
            'match_rounds' => $match_rounds,
        ]);

    }

    public function tgrMatch(Competition $competition) {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $event = Event::where('event_id', $competition->event_id)->first();
        $category = Category::where('category_id', $competition->category_id)->first();
        $age = Age::where('age_id', $competition->age_id)->first();

        $participants = Participant::where('event_id', $competition->event_id)->where('category_id', $competition->category_id)->where('age_id', $competition->age_id)->where('gender', $competition->gender)->orderBy('draw_number', 'ASC')->get();
        $matchtgrs = Matchtgr::where('event_id', $competition->event_id)->where('competition_id', $competition->competition_id)->orderBy('value', 'DESC')->get();

        return view('admin.event.match.tgrMatch', [
            'event' => $event,
            'category' => $category,
            'age' => $age,
            'competition' => $competition,
            'participants' => $participants,
            'matchtgrs' => $matchtgrs,
        ]);

    }

    public function tgrMatchStore(Request $request) {

        $validatedData = $request->validate([
            'event_id' => 'required',
            'competition_id' => 'required',
            'participant_id' => 'required',
            'value' => 'nullable',
            'champion' => 'nullable',
        ]);

        Matchtgr::create($validatedData);

        return back()->with('success', 'Data berhasil disimpan');

    }

    public function tandingMatchStore(Request $request) {


        $validatedData = $request->validate([
            'event_id' => 'required',
            'category_id' => 'required',
            'age_id' => 'required',
            'class_id' => 'required',
            'match_date' => 'required',
            'blue_corner' => 'required',
            'red_corner' => 'required',
            'party_number' => 'required',
            'match_round' => 'required',
        ]);

        Matchtanding::create($validatedData);

        return back()->with('success', 'Data berhasil disimpan');

    }


    public function tandingMatchUpdate(Request $request, Matchtanding $matchtanding) {
        $validatedData = $request->validate([
            'match_date' => 'required|date',
            'winner' => 'nullable|string',
        ]);

        $matchtanding = Matchtanding::findOrFail($matchtanding->matchtanding_id);
        $matchtanding->update($validatedData);

        return redirect()->back()->with('success', 'Data Berhasil Disimpan');
    }


    public function tgrMatchUpdate(Request $request, Matchtgr $matchtgr) {

        // dd($matchtgr);
        $validatedData = $request->validate([
            'value' => 'nullable|string',
            'champion' => 'nullable|string',
        ]);

        $matchtgr = MatchTgr::findOrFail($matchtgr->matchtgr_id);
        $matchtgr->update($validatedData);

        return redirect()->back()->with('success', 'Data Berhasil Disimpan');
    }

    public function tandingMatchDestroy(Matchtanding $matchtanding) {

        try{
            Matchtanding::where('matchtanding_id', $matchtanding->matchtanding_id)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data tidak dapat dihapus, karena data masih diperlukan!',
            ]);
        }

        return back()->with('success', 'Data Berhasil Dihapus');
    }

    public function tgrMatchDestroy(Matchtgr $matchtgr) {

        try{
            Matchtgr::where('matchtgr_id', $matchtgr->matchtgr_id)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data tidak dapat dihapus, karena data masih diperlukan!',
            ]);
        }

        return back()->with('success', 'Data Berhasil Dihapus');
    }


}
