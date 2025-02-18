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
use App\Models\Payment;
use App\Models\Paymentmethod;
use App\Models\Registerathlete;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf as DomPDF;


class EventController extends Controller
{
    public function index() {
        $informations = Information::where('status', 'Publish')->with(['event.banners', 'event.competitions', 'event.documents'])->get();

        return view('user.event.index', [
            'informations' => $informations
        ]);
    }

    public function register(Event $event) {

        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $information = Information::where('event_id', $event->event_id)->first();

        $competitions = Competition::where('event_id', $event->event_id)->get();
        $groupedCompetitions = $competitions->groupBy('category_id');

        $contingent = Contingent::where('user_id', auth()->user()->id)->first();
        $contingent_id = $contingent->contingent_id;

        $athletes = Athlete::where('contingent_id', $contingent_id)->get();

        $registers = Register::with(['category', 'age', 'matchClass', 'athletes'])
        ->where('event_id', $event->event_id)
        ->where('contingent_id', $contingent_id)
        ->get();

        $totalPrice = Register::where('event_id', $event->event_id)
        ->whereHas('athletes', function ($query) use ($contingent_id) {
            $query->where('contingent_id', $contingent_id);
        })
        ->sum('price');

        $payment = Payment::where('event_id', $event->event_id)
        ->where('contingent_id', $contingent_id)
        ->first();


        return view('user.event.register', [
            'information' => $information,
            'groupedCompetitions' => $groupedCompetitions,
            'athletes' => $athletes,
            'event' => $event,
            'registers' => $registers,
            'totalPrice' => $totalPrice,
            'contingent' => $contingent,
            'payment' => $payment,
        ]);
    }

    public function getAges($category_id)
    {
        $competition = Competition::where('category_id', $category_id)->first();
        $event_id = $competition->event_id;


        $ages = Competition::where('category_id', $category_id)
            ->where('event_id', $event_id)
            ->with('age')
            ->get();
    
        $ageData = $ages->map(function ($competition) {
            return [
                'age_id' => $competition->age->age_id,
                'age_name' => $competition->age->age_name . ' - ' . $competition->gender,
                'gender' => $competition->gender,
            ];
        });
    
        return response()->json($ageData);
    }

    public function getClasses($age_id)
    {
       
        $class = Matchclass::where('age_id', $age_id)->get();


        $classData = $class->map(function ($class) {
            return [
                'class_id' => $class->class_id,
                'class_name' => $class->class_name . ' - ' . $class->class_min . 'Kg s/d ' . $class->class_max . 'Kg',
            ];
        });
    
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
            'gender' => 'required',
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
                    'error' => 'Atlet belum dimasukan',
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

        $competition = Competition::where('event_id', $validatedData['event_id'])->where('category_id', $validatedData['category_id'])->where('age_id', $validatedData['age_id'])->first();

        $status = 'Register';
        $contingent = Contingent::where('user_id', auth()->user()->id)->first();
        $contingent_id = $contingent->contingent_id;


        if(isset($validatedData['class_id'])) {
            $register = Register::create([
                'event_id' => $validatedData['event_id'],
                'category_id' => $validatedData['category_id'],
                'age_id' => $validatedData['age_id'],
                'gender' => $validatedData['gender'],
                'class_id' => $validatedData['class_id'],
                'contingent_id' => $contingent_id,
                'price' => $competition->price,
                'status' => $status
            ]);
        } else {
            $register = Register::create([
                'event_id' => $validatedData['event_id'],
                'category_id' => $validatedData['category_id'],
                'age_id' => $validatedData['age_id'],
                'gender' => $validatedData['gender'],
                'contingent_id' => $contingent_id,
                'price' => $competition->price,
                'status' => $status
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

        return back()->with('success', 'Data Berhasil Disimpan');
    }

    public function registerDestroy(Register $register) {
        
        try{
            Registerathlete::where('register_id', $register->register_id)->delete();
            Register::where('register_id', $register->register_id)->delete();       
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data cannot be deleted, because the data is still needed!',
            ]);
        }

        return back()->with('success', 'Data Berhasil Dihapus');
    } 

    public function registerPayment(Event $event) {

        $information = Information::where('event_id', $event->event_id)->first();
        $contingent = Contingent::where('user_id', auth()->user()->id)->first();
        $contingent_id = $contingent->contingent_id;

        $registers = Register::with(['category', 'age', 'matchClass', 'athletes'])
        ->where('event_id', $event->event_id)
        ->where('contingent_id', $contingent_id)
        ->get();

        $amountRegisters = Register::where('event_id', $event->event_id)->where('status', 'Payment')->orWhere('status', 'Match')->count();
        $amountMatchRegisters = Register::where('event_id', $event->event_id)->where('status', 'Match')->count();

        $quota = $information->quota;
        $countRegister = count($registers);
        $totalRegister = $amountRegisters + $countRegister;

        $totalPrice = Register::where('event_id', $event->event_id)
        ->where('contingent_id', $contingent_id)
        ->sum('price');

        $payment = Payment::where('event_id', $event->event_id)
        ->where('contingent_id', $contingent_id)
        ->first();

        if (!isset($payment)) {
            if($amountMatchRegisters == $quota) {
                return redirect()->back()->withErrors([
                    'message' => "Kuota telah penuh"
                ]);
            } else if ($totalRegister > $quota) {
                $excess = $totalRegister - $quota;
                return redirect()->back()->withErrors([
                    'message' => "Kuota telah terlampaui sebanyak $excess registrasi"
                ]);
            }
        }

        $paymentmethods = Paymentmethod::all();

        $uniqueCode = ($contingent_id + 111) % 1000;
        $totalPayment = $totalPrice + $uniqueCode;

        return view('user.event.payment', [
            'event' => $event,
            'information' => $information,
            'contingent' => $contingent,
            'registers' => $registers,
            'totalPrice' => $totalPrice,
            'uniqueCode' => $uniqueCode,
            'totalPayment' => $totalPayment,
            'payment' => $payment,
            'paymentmethods' => $paymentmethods,
        ]);
    }


    public function registerPaymentInvoice(Event $event) {
        $contingent = Contingent::where('user_id', auth()->user()->id)->first();
        $contingent_id = $contingent->contingent_id;

        $registers = Register::with(['category', 'age', 'matchClass', 'athletes'])
        ->where('event_id', $event->event_id)
        ->where('contingent_id', $contingent_id)
        ->get();

        $totalPrice = Register::where('event_id', $event->event_id)
        ->where('contingent_id', $contingent_id)
        ->sum('price');

        $payment = Payment::where('event_id', $event->event_id)
        ->where('contingent_id', $contingent_id)
        ->first();

        $paymentmethods = Paymentmethod::all();
        $uniqueCode = ($contingent_id + 111) % 1000;
        $totalPayment = $totalPrice + $uniqueCode;



        $pdf =  DomPDF::loadView('user.event.invoice', [
            'event' => $event,
            'contingent' => $contingent,
            'registers' => $registers,
            'payment' => $payment,
            'totalPrice' => $totalPrice,
            'uniqueCode' => $uniqueCode,
            'totalPayment' => $totalPayment,
            'paymentmethods' => $paymentmethods,
        ]);

        // Return file PDF untuk diunduh
        return $pdf->stream("Invoice-{$contingent->contingent_name}.pdf");
    }

    public function registerPaymentStore(Request $request, Event $event) {

        // dd($request);

        $validatedData = $request->validate([
            'event_id' => 'required',
            'contingent_id' => 'required',
            'amount' => 'required',
            'status' => 'required',
            'paymentmethod_id' => 'required',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        if($request->file('payment_proof')) {
            $validatedData['payment_proof'] = $request->file('payment_proof')->store('payment_proof');
        }

        Payment::create($validatedData);

        $contingent = Contingent::where('user_id', auth()->user()->id)->first();
        $contingent_id = $contingent->contingent_id;

        Register::where('event_id', $event->event_id)
        ->where('contingent_id', $contingent_id)
        ->update([
            'status' => 'Payment'
        ]);

        return back()->with('success', 'Data Berhasil Disimpan');

    }
}
