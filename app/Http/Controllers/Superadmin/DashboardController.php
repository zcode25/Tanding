<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Contingent;
use App\Models\Athlete;

class DashboardController extends Controller
{
    public function index() {

        $countAdmin = User::where('role', 'Admin')->count();
        $countEvent = Event::count();
        $countContingent = Contingent::count();
        $countAthlete = Athlete::count();

        $events = Event::where('event_status', 'Active')->get();

        return view('superadmin.dashboard.index', [
            'countAdmin' => $countAdmin,
            'countEvent' => $countEvent,
            'countContingent' => $countContingent,
            'countAthlete' => $countAthlete,
            'events' => $events,
        ]);
    }
}
