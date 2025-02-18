<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administrator;
use App\Models\Event;
use App\Models\Contingent;
use App\Models\Athlete;


class DashboardController extends Controller
{
    public function index() {

        $user_id = auth()->user()->id;
        $events = Administrator::where('user_id', $user_id)->get();
        $countEvent = Administrator::where('user_id', $user_id)->count();
        $countContingent = Contingent::count();
        $countAthlete = Athlete::count();


        return view('admin.dashboard.index', [
            'events' => $events,
            'countEvent' => $countEvent,
            'countContingent' => $countContingent,
            'countAthlete' => $countAthlete,
        ]);
    }
}
