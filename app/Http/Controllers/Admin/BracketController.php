<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Competition;
use App\Models\Category;
use App\Models\Matchclass;
use App\Models\Age;
use App\Models\Participant;
use App\Models\Bracket;
use App\Models\Bracketpool;
use App\Models\Bracketparticipant;
use App\Models\Bracketmatch;
use Illuminate\Validation\Rule;

class BracketController extends Controller
{
    public function index(Event $event) {

        $competitions = Competition::join('categories', 'competitions.category_id', '=', 'categories.category_id')
        ->where('competitions.event_id', $event->event_id)
        ->where('categories.category_type', 'Tanding')
        ->select('competitions.*')
        ->get();

        $groupedAges = $competitions;

        return view('admin.event.bracket.index', [
            'event' => $event,
            'groupedAges' => $groupedAges,
        ]);
    }

    public function detail(Competition $competition) {

        $event = Event::where('event_id', $competition->event_id)->first();
        $groupedClasses = Matchclass::where('age_id', $competition->age_id)->get();

        $category = Category::where('category_id', $competition->category_id)->first();
        $age = Age::where('age_id', $competition->age_id)->first();

        return view('admin.event.bracket.detail', [
            'event' => $event,
            'groupedClasses' => $groupedClasses,
            'category' => $category,
            'age' => $age,
            'competition' => $competition
        ]);

    }

    public function tanding(Competition $competition, Matchclass $matchclass) {
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

        return view('admin.event.bracket.tanding', [
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

    public function store(Request $request) {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,event_id',
            'competition_id' => 'required|exists:competitions,competition_id',
            'class_id' => 'required',
            'format' => 'required|string',
            'total_participants' => 'required|integer|min:2',
            'total_pools' => 'nullable|integer|min:1',
        ]);

        $bracket = Bracket::create([
            'event_id' => $validated['event_id'],
            'competition_id' => $validated['competition_id'],
            'class_id' => $validated['class_id'],
            'format' => $validated['format'],
            'total_participants' => $validated['total_participants'],
            'total_pools' => $validated['format'] === 'Pool' ? $validated['total_pools'] : null,
        ]);

        if ($bracket->format === 'Pool' && $bracket->total_pools) {
            for ($i = 1; $i <= $bracket->total_pools; $i++) {
                BracketPool::create([
                    'bracket_id' => $bracket->bracket_id,
                    'pool_number' => $i,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Bagan berhasil ditambahkan!');
    }

    public function destroy(Bracket $bracket) {

        try{
            Bracket::where('bracket_id', $bracket->bracket_id)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return back()->with('success', 'Data deleted successfully');
    }


    public function bracketParticipant(Bracket $bracket) {
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

        return view('admin.event.bracket.bracket', [
            'event' => $event,
            'bracket' => $bracket,
            'participants' => $participants,
            'bracketparticipants' => $bracketparticipants,
            'bracketparticipants2' => $bracketparticipants2,
            'pools' => $pools,
            'types' => $types,
            'matches' => $matches,
            'matches2' => $matches2,
        ]);
    }

    public function bracketParticipantStore(Request $request, Bracket $bracket)
    {
       
        $validated = $request->validate([
            'participant_id' => 'required|exists:participants,participant_id',
            'pool_id' => $bracket->format === 'Pool' ? 'required|exists:bracketpools,pool_id' : 'nullable',
        ]);


        BracketParticipant::create([
            'bracket_id' => $bracket->bracket_id,
            'participant_id' => $validated['participant_id'],
            'pool_id' => $validated['pool_id'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Peserta berhasil ditambahkan!');
    }

    public function bracketParticipantDestroy(Bracketparticipant $bracketparticipant) {

        try{
            Bracketparticipant::where('bracketpart_id', $bracketparticipant->bracketpart_id)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return back()->with('success', 'Data deleted successfully');
    }


    public function bracketMatchStore(Request $request, Bracket $bracket)
    {

        // dd($request);
        $validated = $request->validate([
            'pool_id' => 'nullable|exists:bracketpools,pool_id',
            'match_number' => 'required|integer',
            'round' => 'required|integer',
            'participant_1' => 'required',
            'participant_2' => 'required',
            'status' => 'required|in:Scheduled,Ongoing,Completed',
        ]);

        $participant1 = ($validated['participant_1'] == 'BYE') ? null : $validated['participant_1'];
        $participant2 = ($validated['participant_2'] == 'BYE') ? null : $validated['participant_2'];
    
        Bracketmatch::create([
            'bracket_id' => $bracket->bracket_id,
            'pool_id' => $validated['pool_id'] ?? null,
            'match_number' => $validated['match_number'],
            'round' => $validated['round'],
            'participant_1' => $participant1,
            'participant_2' => $participant2,
            'status' => $validated['status'],
        ]);
    
        return redirect()->back()->with('success', 'Match berhasil ditambahkan!');
    }


    public function bracketMatchUpdate(Request $request, Bracketmatch $bracketmatch)
    {

        $validated = $request->validate([
            'pool_id' => 'nullable|exists:bracketpools,pool_id',
            'match_number' => 'required|integer',
            'round' => 'required|integer',
            'participant_1' => 'required',
            'participant_2' => 'required',
            'winner' => 'nullable',
            'status' => 'required|in:Scheduled,Ongoing,Completed',
        ]);

        $participant1 = ($validated['participant_1'] == 'BYE') ? null : $validated['participant_1'];
        $participant2 = ($validated['participant_2'] == 'BYE') ? null : $validated['participant_2'];
    
        Bracketmatch::where('match_id', $bracketmatch->match_id)->update([
            'pool_id' => $validated['pool_id'] ?? null,
            'match_number' => $validated['match_number'],
            'round' => $validated['round'],
            'participant_1' => $participant1,
            'participant_2' => $participant2,
            'winner_id' => $validated['winner'],
            'status' => $validated['status'],
        ]);
    
        return redirect()->back()->with('success', 'Match berhasil ditambahkan!');
    }

    public function bracketMatchDestroy(Bracketmatch $bracketmatch) {

        try{
            Bracketmatch::where('match_id', $bracketmatch->match_id)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return back()->with('success', 'Data deleted successfully');
    }

}
