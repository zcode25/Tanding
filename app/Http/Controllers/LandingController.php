<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;
use App\Models\Event;
use App\Models\Contingent;
use App\Models\Athlete;

class LandingController extends Controller
{
    public function index() {

        $informations = Information::where('status', 'Publish')->with(['event.banners', 'event.competitions', 'event.documents'])->get();
        $countEvent = Event::count();
        $countContingent = Contingent::count();
        $countAthlete = Athlete::count();

        return view('landing.index', [
            'informations' => $informations,
            'countEvent' => $countEvent,
            'countContingent' => $countContingent,
            'countAthlete' => $countAthlete,
        ]);
    }
}
