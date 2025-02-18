<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Register;
use App\Models\Competition;
use App\Models\Category;
use App\Models\Age;
use App\Models\Matchclass;
use App\Models\Participant;
use App\Exports\ParticipantTemplateExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ParticipantImport;
use App\Exports\ParticipantsExport;

class ParticipantController extends Controller
{
    public function index(Event $event) {

        $competitions = Competition::where('event_id', $event->event_id)->get();
        $groupedCompetitions = $competitions->groupBy('category_id');

        return view('admin.event.participant.index', [
            'event' => $event,
            'groupedCompetitions' => $groupedCompetitions,
        ]);
    }

    public function detail(Competition $competition) {

        $event = Event::where('event_id', $competition->event_id)->first();
        $competitions = Competition::where('event_id', $event->event_id)->where('category_id', $competition->category_id)->get();
        $category = Category::where('category_id', $competition->category_id)->first();

        // $groupedAges = $competitions->groupBy('age_id');
        $groupedAges = $competitions;

        return view('admin.event.participant.detail', [
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

        return view('admin.event.participant.tanding', [
            'event' => $event,
            'groupedClasses' => $groupedClasses,
            'category' => $category,
            'age' => $age,
            'competition' => $competition
        ]);

    }

    public function tandingParticipant(Competition $competition, Matchclass $matchclass) {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $event = Event::where('event_id', $competition->event_id)->first();
        $category = Category::where('category_id', $competition->category_id)->first();
        $age = Age::where('age_id', $competition->age_id)->first();

        $participants = Participant::where('event_id', $competition->event_id)->where('category_id', $competition->category_id)->where('age_id', $competition->age_id)->where('gender', $competition->gender)->where('class_id', $matchclass->class_id)->get();

        return view('admin.event.participant.tandingParticipant', [
            'event' => $event,
            'category' => $category,
            'age' => $age,
            'competition' => $competition,
            'matchclass' => $matchclass,
            'participants' => $participants,
        ]);
    }

    public function tgrParticipant(Competition $competition) {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $event = Event::where('event_id', $competition->event_id)->first();
        $category = Category::where('category_id', $competition->category_id)->first();
        $age = Age::where('age_id', $competition->age_id)->first();

        $participants = Participant::where('event_id', $competition->event_id)->where('category_id', $competition->category_id)->where('age_id', $competition->age_id)->where('gender', $competition->gender)->get();

        return view('admin.event.participant.tgrParticipant', [
            'event' => $event,
            'category' => $category,
            'age' => $age,
            'competition' => $competition,
            'participants' => $participants,
        ]);
    }

    public function tandingParticipantStore(Request $request) {

        $validatedData = $request->validate([
            'event_id' => 'required|integer',
            'category_id' => 'required|integer',
            'age_id' => 'required|integer',
            'gender' => 'required',
            'class_id' => 'required|integer',
            'athlete_name' => 'required|array|min:1',
            'contingent_name' => 'required|string|max:255',
        ]);
    
        $validatedData['athlete_name'] = json_encode($request->athlete_name);
    
        Participant::create($validatedData);
    
        return back()->with('success', 'Data berhasil disimpan');
    }

    public function tgrParticipantStore(Request $request) {

        $category = Category::find($request->category_id);

        $validatedData = $request->validate([
            'event_id' => 'required|integer',
            'category_id' => 'required|integer',
            'age_id' => 'required|integer',
            'gender' => 'required',
            'athlete_name' => 'required|array|min:1',
            'contingent_name' => 'required|string|max:255',
        ]);

        $athleteCount = match ($category->category_amount) {
            'Single' => 1,
            'Double' => 2,
            'Group'  => 3,
        };
    
        if (count($validatedData['athlete_name']) < $athleteCount) {
            return back()->with('error', "Jumlah atlet harus $athleteCount orang");
        }
    
        // Cek apakah ada atlet yang kosong setelah filter
        foreach ($validatedData['athlete_name'] as $key => $name) {
            if (trim($name) === '') {
                return back()->with('error', "Nama Atlet ke-" . ($key + 1) . " tidak boleh kosong");
            }
        }
    
    
        $validatedData['athlete_name'] = json_encode($request->athlete_name);
    
        Participant::create($validatedData);
    
        return back()->with('success', 'Data berhasil disimpan');
    }

    public function participantDestroy(Participant $participant) {
        

        try{
            Participant::where('participant_id', $participant->participant_id)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return back()->with('success', 'Data deleted successfully');
    }

    public function downloadTemplate()
    {
        return Excel::download(new ParticipantTemplateExport, 'Template_Participant.xlsx');
    }
    
    public function importTemplate(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new ParticipantImport(
            $request->event_id,
            $request->category_id,
            $request->age_id,
            $request->gender,
            $request->class_id
        ), $request->file('file'));

        return back()->with('success', 'Data peserta berhasil diimpor!');
    }




    

    public function tandingDraw(Competition $competition, Matchclass $matchclass) {

        $event = Event::where('event_id', $competition->event_id)->first();
        $category = Category::where('category_id', $competition->category_id)->first();
        $age = Age::where('age_id', $competition->age_id)->first();

        $participants = Participant::where('event_id', $competition->event_id)->where('category_id', $competition->category_id)->where('age_id', $competition->age_id)->where('class_id', $matchclass->class_id)->get();

        return view('admin.event.participant.tandingDraw', [
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

        $participants = Participant::where('event_id', $competition->event_id)->where('category_id', $competition->category_id)->where('age_id', $competition->age_id)->get();

        return view('admin.event.participant.tgrDraw', [
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

        $participants = Participant::where('event_id', $competition->event_id)->where('category_id', $competition->category_id)->where('age_id', $competition->age_id)->where('class_id', $matchclass->class_id)->orderBy('draw_number', 'ASC')->get();

        return Excel::download(new ParticipantsExport($participants), 'participants.xlsx');
    }

    public function tgrExportDraw(Competition $competition)
    {
        $event = Event::where('event_id', $competition->event_id)->first();
        $category = Category::where('category_id', $competition->category_id)->first();
        $age = Age::where('age_id', $competition->age_id)->first();

        $participants = Participant::where('event_id', $competition->event_id)->where('category_id', $competition->category_id)->where('age_id', $competition->age_id)->orderBy('draw_number', 'ASC')->get();

        return Excel::download(new ParticipantsExport($participants), 'participants.xlsx');
    }
}
