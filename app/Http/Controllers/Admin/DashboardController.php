<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administrator;

class DashboardController extends Controller
{
    public function index() {

        $user_id = auth()->user()->id;
        $eventHandle = Administrator::where('user_id', $user_id)->count();

        return view('admin.dashboard.index', [
            'eventHandle' => $eventHandle
        ]);
    }
}
