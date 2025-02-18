<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Register;
use App\Models\Competition;
use App\Models\Category;
use App\Models\Draw;
use App\Models\Matchtanding;
use App\Models\Matchclass;
use App\Models\Matchtgr;
use App\Models\Medal;
use App\Models\Age;
use App\Models\Participant;
use App\Models\Bracket;
use App\Models\Bracketpool;
use App\Models\Bracketparticipant;
use App\Models\Bracketmatch;

class MedalController extends Controller
{
    public function index(Event $event) {
        $competitions = Competition::where('event_id', $event->event_id)->get();
        $groupedCompetitions = $competitions->groupBy('category_id');

        return view('admin.event.medal.index', [
            'event' => $event,
            'groupedCompetitions' => $groupedCompetitions,
        ]);
    }

    public function indexRecap(Event $event) {
        $medals = Medal::where('event_id', $event->event_id)
        ->with('participant')
        ->get()
        ->groupBy(function ($medal) {
            return $medal->participant ? $medal->participant->contingent_name : 'Tidak Diketahui';
        })
        ->map(function ($group) {
            return [
                'total' => $group->count(),
                'emas' => $group->where('medal', 'Emas')->count(),
                'perak' => $group->where('medal', 'Perak')->count(),
                'perunggu' => $group->where('medal', 'Perunggu')->count(),
                'medals' => $group,
            ];
        });
    

    
        return view('admin.event.medal.recap', [
            'event' => $event,
            'medals' => $medals,
        ]);
    }
    

    public function detail(Competition $competition) {

        $event = Event::where('event_id', $competition->event_id)->first();
        $competitions = Competition::where('event_id', $event->event_id)->where('category_id', $competition->category_id)->get();
        $category = Category::where('category_id', $competition->category_id)->first();

        $groupedAges = $competitions;

        return view('admin.event.medal.detail', [
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

        return view('admin.event.medal.tanding', [
            'event' => $event,
            'groupedClasses' => $groupedClasses,
            'category' => $category,
            'age' => $age,
            'competition' => $competition
        ]);

    }

    public function tandingMedal(Competition $competition, Matchclass $matchclass) {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $event = Event::where('event_id', $competition->event_id)->first();
        $category = Category::where('category_id', $competition->category_id)->first();
        $age = Age::where('age_id', $competition->age_id)->first();

        $participants = Participant::where('event_id', $competition->event_id)
            ->where('category_id', $competition->category_id)
            ->where('age_id', $competition->age_id)
            ->where('class_id', $matchclass->class_id)
            ->where('gender', $competition->gender)
            ->get();

        $types = [
            [
                "type" => "Full"
            ],
            [
                "type" => "Pool"
            ],
        ];

        $brackets = Bracket::where('event_id', $competition->event_id)->where('competition_id', $competition->competition_id)->where('class_id', $matchclass->class_id)->get();

        return view('admin.event.medal.tandingMedal', [
            'event' => $event,
            'category' => $category,
            'age' => $age,
            'competition' => $competition,
            'matchclass' => $matchclass,
            'participants' => $participants,
            'types' => $types,
            'brackets' => $brackets,
        ]);

    }

    public function tandingMedalParticipant(Bracket $bracket) {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
       
        $event = Event::where('event_id', $bracket->event_id)->first();
        $participants = Participant::where('event_id', $bracket->event_id)
            ->where('category_id', $bracket->competition->category_id)
            ->where('age_id', $bracket->competition->age_id)
            ->where('class_id', $bracket->class_id)
            ->where('gender', $bracket->competition->gender)
            ->orderBy('draw_number', 'ASC')
            ->get();

        $pools = BracketPool::where('bracket_id', $bracket->bracket_id)->get(); // Ambil daftar pool
        
        $bracketparticipants = BracketParticipant::where('bracket_id', $bracket->bracket_id)->get();

        $bracketparticipants2 = $bracketparticipants->map(function ($bracketparticipant) {
            $athlete_name = json_decode($bracketparticipant->participant->athlete_name);
            $bracketparticipant->participant->athlete_name = is_array($athlete_name) ? $athlete_name[0] : $athlete_name;
            return $bracketparticipant;
        });

        $matches = BracketMatch::with(['bracket', 'pool', 'participantOne', 'participantTwo', 'winner'])->where('bracket_id', $bracket->bracket_id)->orderBy('match_number', 'asc')->get();
        $matches2 = BracketMatch::with(['bracket', 'pool', 'participantOne', 'participantTwo', 'winner'])
                ->where('bracket_id', $bracket->bracket_id)
                ->orderBy('match_number', 'asc')
                ->get()
                ->map(function ($match) {
                    if ($match->participantOne && $match->participantOne->athlete_name) {
                        $athlete_name_one = json_decode($match->participantOne->athlete_name);
                        $match->participantOne->athlete_name = is_array($athlete_name_one) ? $athlete_name_one[0] : $athlete_name_one;
                    }

                    if ($match->participantTwo && $match->participantTwo->athlete_name) {
                        $athlete_name_two = json_decode($match->participantTwo->athlete_name);
                        $match->participantTwo->athlete_name = is_array($athlete_name_two) ? $athlete_name_two[0] : $athlete_name_two;
                    }

                    if ($match->winner && $match->winner->athlete_name) {
                        $athlete_name_winner = json_decode($match->winner->athlete_name);
                        $match->winner->athlete_name = is_array($athlete_name_winner) ? $athlete_name_winner[0] : $athlete_name_winner;
                    }

                    return $match;
                });

        $medaltandings = Medal::where('event_id', $bracket->event_id)->where('competition_id', $bracket->competition_id)->where('class_id', $bracket->class_id)->get();

        $types = [
            [
                "type" => "Scheduled"
            ],
            [
                "type" => "Ongoing"
            ],
            [
                "type" => "Completed"
            ],
        ];

        $medals = [
            [
                "medal" => "Emas"
            ],
            [
                "medal" => "Perak"
            ],
            [
                "medal" => "Perunggu"
            ],
        ];

        return view('admin.event.medal.tandingMedalParticipant', [
            'event' => $event,
            'bracket' => $bracket,
            'participants' => $participants,
            'bracketparticipants' => $bracketparticipants,
            'bracketparticipants2' => $bracketparticipants2,
            'pools' => $pools,
            'types' => $types,
            'matches' => $matches,
            'matches2' => $matches2,
            'medals' => $medals,
            'medaltandings' => $medaltandings,
        ]);
    }

    public function tgrMedal(Competition $competition) {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $event = Event::where('event_id', $competition->event_id)->first();
        $category = Category::where('category_id', $competition->category_id)->first();
        $age = Age::where('age_id', $competition->age_id)->first();

        $participants = Participant::where('event_id', $competition->event_id)->where('category_id', $competition->category_id)->where('age_id', $competition->age_id)->where('gender', $competition->gender)->orderBy('draw_number', 'ASC')->get();
        $matchtgrs = Matchtgr::where('event_id', $competition->event_id)->where('competition_id', $competition->competition_id)->orderBy('value', 'DESC')->get();
        $medaltgrs = Medal::where('event_id', $competition->event_id)->where('competition_id', $competition->competition_id)->get();

        $medals = [
            [
                "medal" => "Emas"
            ],
            [
                "medal" => "Perak"
            ],
            [
                "medal" => "Perunggu"
            ],
        ];

        return view('admin.event.medal.tgrMedal', [
            'event' => $event,
            'category' => $category,
            'age' => $age,
            'competition' => $competition,
            'participants' => $participants,
            'matchtgrs' => $matchtgrs,
            'medaltgrs' => $medaltgrs,
            'medals' => $medals,
        ]);

    }

    public function tandingMedalStore(Request $request) {

        $validatedData = $request->validate([
            'event_id' => 'required',
            'category_id' => 'required',
            'age_id' => 'required',
            'class_id' => 'required',
            'draw_id' => 'required',
            'medal' => 'required',
        ]);

        $validatedData['contingent_id'] = $draw->register->contingent_id;

        Medal::create($validatedData);

        return back()->with('success', 'Data berhasil disimpan');
    }

    public function medalStore(Request $request) {

       if($request->class_id) {
            $validatedData = $request->validate([
                'event_id' => 'required',
                'competition_id' => 'required',
                'participant_id' => 'required',
                'class_id' => 'required',
                'medal' => 'required',
            ]);
       } else {
            $validatedData = $request->validate([
                'event_id' => 'required',
                'competition_id' => 'required',
                'participant_id' => 'required',
                'medal' => 'required',
            ]);
       }

        Medal::create($validatedData);

        return back()->with('success', 'Data berhasil disimpan');
    }


    public function medalDestroy(Medal $medal) {

        try{
            Medal::where('medal_id', $medal->medal_id)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data tidak dapat dihapus, karena data masih diperlukan!',
            ]);
        }

        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
