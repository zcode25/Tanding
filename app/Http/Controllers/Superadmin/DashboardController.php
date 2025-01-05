<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;

class DashboardController extends Controller
{
    public function index() {

        $countAdmin = User::where('role', 'Admin')->count();
        $countEvent = Event::count();

        return view('superadmin.dashboard.index', [
            'countAdmin' => $countAdmin,
            'countEvent' => $countEvent
        ]);
    }
}
