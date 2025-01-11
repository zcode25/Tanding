<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Information;
use App\Models\Event;
use App\Models\Competition;
use App\Models\Matchclass;
use App\Models\Category;
use App\Models\Athlete;
use App\Models\Contingent;
use App\Models\Register;
use App\Models\Registerathlete;
use Illuminate\Validation\Rule;


class EventController extends Controller
{
    public function index() {
        $informations = Information::where('status', 'Publish')->with(['event.banners', 'event.competitions', 'event.documents'])->get();

        return view('user.event.index', [
            'informations' => $informations
        ]);
    }

    public function register(Event $event) {

        $informations = Information::where('event_id', $event->event_id)->with(['event.banners', 'event.competitions', 'event.documents'])->get();

        $competitions = Competition::where('event_id', $event->event_id)->get();
        $groupedCompetitions = $competitions->groupBy('category_id');

        $contingent = Contingent::where('user_id', auth()->user()->id)->first();
        $contingent_id = $contingent->contingent_id;

        $athletes = Athlete::where('contingent_id', $contingent_id)->get();

        $registers = Register::with(['category', 'age', 'matchClass', 'athletes'])
        ->where('event_id', $event->event_id)
        ->whereHas('athletes', function ($query) use ($contingent_id) {
            $query->where('contingent_id', $contingent_id);
        })
        ->get();

        // dd($registers);

        return view('user.event.register', [
            'informations' => $informations,
            'groupedCompetitions' => $groupedCompetitions,
            'athletes' => $athletes,
            'event' => $event,
            'registers' => $registers,
        ]);
    }

    public function getAges($category_id)
    {
        // Ambil data competition berdasarkan category_id dan muat relasi 'age'
        $competition = Competition::where('category_id', $category_id)->first();
        $event_id = $competition->event_id;


        $ages = Competition::where('category_id', $category_id)
            ->where('event_id', $event_id)
            ->with('age')  // Muat relasi 'age' pada model Competition
            ->get();
    
        // Ambil hanya data yang dibutuhkan: age_id dan age_name dari tabel ages
        $ageData = $ages->map(function ($competition) {
            return [
                'age_id' => $competition->age->age_id,
                'age_name' => $competition->age->age_name,
            ];
        });
    
        // Mengembalikan data dalam format JSON
        return response()->json($ageData);
    }

    public function getClasses($age_id)
    {
       
        $class = Matchclass::where('age_id', $age_id)->get();


        $classData = $class->map(function ($class) {
            return [
                'class_id' => $class->class_id,
                'class_name' => $class->class_name . ' - ' . $class->class_min . 'Kg s/d ' . $class->class_max . 'Kg ('. $class->class_gender . ')',
            ];
        });
    
        // Mengembalikan data dalam format JSON
        return response()->json($classData);
    }

    public function getCategoryAmount($category_id)
    {
        $category = Category::where('category_id', $category_id)->first();

        if ($category) {
            return response()->json(['category_amount' => $category->category_amount]);
        }

        return response()->json(['error' => 'Category not found'], 404);
    }

    public function registerStore(Request $request) {
        $messages = [
            'class_id.required_if' => 'The class group is required when the competition type is tanding.',
        ];
        
        $validatedData = $request->validate([
            'event_id' => 'required',
            'category_id' => 'required',
            'age_id' => 'required',
            'class_id' => [
                'nullable',
                Rule::requiredIf(function () use ($request) {
                    $category = Category::find($request->category_id);
                    return $category && $category->category_type === 'Tanding';
                }),
            ],
            'athlete_id' => 'required|array',
            'athlete_id.*' => 'nullable',

        ], $messages);

        $category = Category::find($request->category_id);

        if($category->category_amount == 'Single') {
            if($validatedData['athlete_id'][0] == null) {
                return back()->with([
                    'error' => 'Athlete belum dimasukan',
                ]);
            }
        } else if ($category->category_amount == 'Double') {
            if($validatedData['athlete_id'][0] == null) {
                return back()->with([
                    'error' => 'Athlete belum dimasukan',
                ]);
            }
            if($validatedData['athlete_id'][1] == null) {
                return back()->with([
                    'error' => 'Athlete belum dimasukan',
                ]);
            }
        } else if ($category->category_amount == 'Group') {
            if($validatedData['athlete_id'][0] == null) {
                return back()->with([
                    'error' => 'Athlete belum dimasukan',
                ]);
            }
            if($validatedData['athlete_id'][1] == null) {
                return back()->with([
                    'error' => 'Athlete belum dimasukan',
                ]);
            }
            if($validatedData['athlete_id'][2] == null) {
                return back()->with([
                    'error' => 'Athlete belum dimasukan',
                ]);
            }
        }

        $competition = Competition::where('event_id', $validatedData['event_id'])->where('age_id', $validatedData['age_id'])->first();


        if(isset($validatedData['class_id'])) {
            $register = Register::create([
                'event_id' => $validatedData['event_id'],
                'category_id' => $validatedData['category_id'],
                'age_id' => $validatedData['age_id'],
                'class_id' => $validatedData['class_id'],
                'price' => $competition->price
            ]);
        } else {
            $register = Register::create([
                'event_id' => $validatedData['event_id'],
                'category_id' => $validatedData['category_id'],
                'age_id' => $validatedData['age_id'],
                'price' => $competition->price
            ]);
        }


        foreach ($validatedData['athlete_id'] as $athleteId) {
            if ($athleteId) { 
                Registerathlete::create([
                    'register_id' => $register->register_id,
                    'athlete_id' => $athleteId,
                ]);
            }
        }

        return back()->with('success', 'Data saved successfully');
    }
}
