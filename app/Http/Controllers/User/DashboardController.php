<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contingent;
use App\Models\Athlete;
use App\Models\Information;

class DashboardController extends Controller
{
    public function index() {
        $contingent = Contingent::where('user_id', auth()->user()->id)->first();
        $countAthlete = Athlete::where('contingent_id', $contingent->contingent_id)->count();

        $informations = Information::where('status', 'Publish')->with(['event.banners', 'event.competitions', 'event.documents'])->orderBy('created_at', 'desc')->get();


        return view('user.dashboard.index', [
            'countAthlete' => $countAthlete,
            'informations' => $informations
        ]);
    }
}
