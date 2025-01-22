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
use Illuminate\Support\Collection;

class DrawController extends Controller
{
    public function index(Event $event) {
        $registers = Register::with(['category', 'age', 'matchClass', 'athletes'])
        ->where('event_id', $event->event_id)
        ->where('status', 'Match')
        ->get();

        $competitions = Competition::where('event_id', $event->event_id)->get();
        $groupedCompetitions = $competitions->groupBy('category_id');

        $groupedByCategory = $registers->groupBy('category.category_name');

        $categoryCounts = $groupedByCategory->map(function ($group) {
            return $group->count();
        });

        return view('admin.event.draw.index', [
            'event' => $event,
            'registers' => $registers,
            'groupedCompetitions' => $groupedCompetitions,
            'categoryCounts' => $categoryCounts
        ]);
    }

    public function detail(Competition $competition) {

        $event = Event::where('event_id', $competition->event_id)->first();
        $category = Category::where('category_id', $competition->category_id)->first();

        $registers = Register::with(['category', 'age', 'matchClass', 'athletes'])
        ->where('event_id', $event->event_id)
        ->where('category_id', $competition->category_id)
        ->get();

        $groupedAges = $registers->groupBy('age_id');
        $category_name = $registers->first()->category->category_name;

        return view('admin.event.draw.detail', [
            'event' => $event,
            'groupedAges' => $groupedAges,
            'category_name' => $category_name,
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

        return view('admin.event.draw.tanding', [
            'event' => $event,
            'groupedClasses' => $groupedClasses,
            'category_name' => $category_name,
            'age_name' => $age_name,
        ]);

    }

    public function tgrDraw(Register $register) {
        $event = Event::where('event_id', $register->event_id)->first();
        $category = Category::where('category_id', $register->category_id)->first();

        $registers = Register::with(['category', 'age', 'athletes'])
        ->where('event_id', $event->event_id)
        ->where('category_id', $register->category_id)
        ->where('age_id', $register->age_id)
        ->get();

        $draws = Draw::with(['category', 'age', 'register.registerAthletes.athlete'])
        ->where('event_id', $event->event_id)
        ->where('category_id', $register->category_id)
        ->where('age_id', $register->age_id)
        ->orderBy('draw_number', 'ASC')
        ->get();

        $category_name = $registers->first()->category->category_name;
        $age_name = $registers->first()->age->age_name;

        $category_id = $registers->first()->category->category_id;
        $age_id = $registers->first()->age->age_id;

        return view('admin.event.draw.tgrDraw', [
            'event' => $event,
            'category_name' => $category_name,
            'age_name' => $age_name,
            'category_id' => $category_id,
            'age_id' => $age_id,
            'registers' => $registers,
            'draws' => $draws,
        ]);

    }

    public function tandingDraw(Register $register) {

        $event = Event::where('event_id', $register->event_id)->first();
        $category = Category::where('category_id', $register->category_id)->first();

        $registers = Register::with(['category', 'age', 'matchClass', 'athletes'])
        ->where('event_id', $event->event_id)
        ->where('category_id', $register->category_id)
        ->where('age_id', $register->age_id)
        ->where('class_id', $register->class_id)
        ->get();

        $draws = Draw::with(['category', 'age', 'matchClass', 'register.registerAthletes.athlete'])
        ->where('event_id', $event->event_id)
        ->where('category_id', $register->category_id)
        ->where('age_id', $register->age_id)
        ->where('class_id', $register->class_id)
        ->orderBy('draw_number', 'ASC')
        ->get();


        $mappedDraws = $draws->map(function ($draw) {
        
            $athlete = $draw->register->registerAthletes->first()->athlete ?? null;
        
            return [
                'draw_number' => $draw->draw_number,
                'athlete' => [
                    'name' => $athlete->athlete_name ?? 'TBD',
                    'team' => $athlete->contingent->contingent_name ?? 'TBD',
                ],
            ];
        });
        


        $teams = [];
        $chunkedDraws = $mappedDraws->chunk(2); // Membagi data menjadi pasangan 2

        foreach ($chunkedDraws as $pair) {
            $teamPair = $pair->map(function ($item) {
                return $item['athlete']['name'] . ' (' . $item['athlete']['team'] . ')'; // Menggabungkan nama dan tim
            })->values()->toArray(); // Menambahkan values() untuk memastikan array sederhana tanpa key numerik
            
            // Jika hanya 1 item dalam chunk, tambahkan null sebagai pasangan
            if (count($teamPair) === 1) {
                $teamPair[] = "bye";
            }

            $teams[] = $teamPair;

        }

        $saveData = [
            'teams' => $teams
        ];

        $category_name = $registers->first()->category->category_name;
        $age_name = $registers->first()->age->age_name;
        $class_name = $registers->first()->matchClass->class_name;

        $category_id = $registers->first()->category->category_id;
        $age_id = $registers->first()->age->age_id;
        $class_id = $registers->first()->matchClass->class_id;

        return view('admin.event.draw.tandingDraw', [
            'event' => $event,
            'category_name' => $category_name,
            'age_name' => $age_name,
            'class_name' => $class_name,
            'category_id' => $category_id,
            'age_id' => $age_id,
            'class_id' => $class_id,
            'registers' => $registers,
            'draws' => $draws,
            'bracketData' => $saveData,
        ]);

    }

    public function tgrDrawStore(Request $request) {
        $registers = Register::where('event_id', $request->event_id)
        ->where('category_id', $request->category_id)
        ->where('age_id', $request->age_id)
        ->where('status', 'Match')
        ->get();

        $drawNumbers = range(1, $registers->count());
        shuffle($drawNumbers); 

        foreach ($registers as $index => $register) {
            Draw::create([
                'event_id' => $request->event_id,
                'register_id' => $register->register_id,
                'category_id' => $request->category_id,
                'age_id' => $request->age_id,
                'draw_number' => $drawNumbers[$index],
            ]);
        }

        return back()->with('success', 'Nomor undian berhasil di-generate!');
    }

    public function tandingDrawStore(Request $request) {

        $registers = Register::where('event_id', $request->event_id)
        ->where('category_id', $request->category_id)
        ->where('age_id', $request->age_id)
        ->where('class_id', $request->class_id)
        ->where('status', 'Match')
        ->get();

        $drawNumbers = range(1, $registers->count());
        shuffle($drawNumbers); 

        foreach ($registers as $index => $register) {
            Draw::create([
                'event_id' => $request->event_id,
                'register_id' => $register->register_id,
                'category_id' => $request->category_id,
                'age_id' => $request->age_id,
                'class_id' => $request->class_id,
                'draw_number' => $drawNumbers[$index],
            ]);
        }

        return back()->with('success', 'Nomor undian berhasil di-generate!');

    }

    public function tandingDrawReshuffle(Request $request)
    {
        Draw::where('event_id', $request->event_id)
            ->where('category_id', $request->category_id)
            ->where('age_id', $request->age_id)
            ->where('class_id', $request->class_id)
            ->delete();

        $registers = Register::with('athletes')
            ->where('event_id', $request->event_id)
            ->where('category_id', $request->category_id)
            ->where('age_id', $request->age_id)
            ->where('class_id', $request->class_id)
            ->where('status', 'Match')
            ->get();

        $drawNumbers = range(1, $registers->count());
        shuffle($drawNumbers);

        foreach ($registers as $index => $register) {
            Draw::create([
                'event_id' => $request->event_id,
                'register_id' => $register->register_id,
                'category_id' => $request->category_id,
                'age_id' => $request->age_id,
                'class_id' => $request->class_id,
                'draw_number' => $drawNumbers[$index],
            ]);
        }

        return back()->with('success', 'Nomor undian berhasil di-shuffle ulang!');
    }

    public function tandingDrawUpdate(Request $request, Draw $draw)
    {
        $request->validate([
            'draw_number' => 'required|integer|min:1',
        ]);

        $draw = Draw::findOrFail($draw->draw_id);
        $draw->draw_number = $request->draw_number;
        $draw->save();

        return redirect()->back()->with('success', 'Draw number updated successfully.');
    }

  
}
